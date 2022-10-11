<?php

namespace App\Models;

use App\Http\Resources\StudentResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use function Illuminate\Events\queueable;

/**
 * This class is Student model class with all student management related functions and variables.
 *
 * @package Meritest_LMS_Student_Model
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/students
 */
class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent_id',
        'email',
        'password',
        'roll_number',
        'aadhaar',
        'board_id',
        'standard_id',
        'language_id',
        'batch_id',
        'course_id',
        'mobile',
        'alt_mobile',
        'gender',
        'avatar',
        'dob',
        'permanent_address',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'parent_password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'dob' => 'datetime',
    ];

    /**
     * The attributes that are searchable.
     *
     * @var array
     */
    protected $searchable = [
        'name',
        'email',
        'aadhaar',
        'mobile',
        'alt_mobile',
        'dob',
    ];

    /**
     * The attributes that are sortable.
     *
     * @var array
     */
    protected $sortable = [
        'name',
        'email',
    ];

    /**
     * @return HasOne
     */
    public function student_parent(): HasOne
    {
        return $this->hasOne(StudentParent::class, 'parent_id');
    }

    /**
     * @return BelongsTo
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'board_id');
    }

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return BelongsTo
     */
    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class, 'standard_id');
    }

    /**
     * @return BelongsTo
     */
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    /**
     * @return HasMany
     */
    public function generated_question_papers() :HasMany
    {
        return $this->hasMany(GeneratedQuestionPaper::class);
    }

    /**
     * @return HasMany
     */
    public function student_papers() :HasMany
    {
        return $this->hasMany(StudentPaper::class);
    }


    /**
     * @param StudentResource $student
     * @return array
     */
    public function manipulateStudentInfo(StudentResource $student): array
    {
        // Info: Here we are sending only basic information to student.
        $response['info'] = [
            "id" => $student->id,
            "name" => $student->name,
            "email" => $student->email,
            "aadhaar" => $student->aadhaar,
            "board_id" => $student->board_id,
            "board" => $student->board->name,
            "standard_id" => $student->standard_id,
            "standard" => $student->standard->name,
            "batch_id" => $student->batch_id,
            "batch" => $student->batch->name,
            "course_id" => $student->course_id,
            "mobile" => $student->mobile,
            "alt_mobile" => $student->alt_mobile,
            "gender" => $student->gender,
            "dob" => $student->dob,
            "permanent_address" => $student->permanent_address,
            "address" => $student->address,
            "mother_name" => $student->mother_name,
            "mother_email" => $student->mother_email,
            "mother_mobile" => $student->mother_mobile,
            "mother_qualification" => $student->mother_qualification,
            "mother_occupation" => $student->mother_occupation,
            "father_name" => $student->father_name,
            "father_email" => $student->father_email,
            "father_mobile" => $student->father_mobile,
            "father_qualification" => $student->father_qualification,
            "father_occupation" => $student->father_occupation,
            "avatar" => $student->avatar,
        ];
        // Info: Now we have to check and manipulate student paper
        if (!empty($student->student_papers)) {
            // First: We will make an array of papers, subject wise.
            // Means, all the question paper of a subject will be in one array.
            foreach ($student->student_papers as $paper) {
                $key = json_decode($paper->subject->label);
                $defaultValue = [
                    'id' => $paper->id,
                    'batch_id' => $paper->batch_id,
                    'course_id' => $paper->course_id,
                    'subject_id' => $paper->subject_id,
                    'attempted_on' => $paper->attempted_on,
                    'total_time' => $paper->total_time,
                    'total_time_taken' => $paper->total_time_taken,
                    'total_marks' => $paper->total_marks,
                    'total_marks_scored' => $paper->total_marks_scored,
                    'unique_code' => $paper->unique_code,
                    'start_date' => $paper->start_date,
                    'end_date' => $paper->end_date,
                    'can_retest' => $paper->can_retest,
                    'show_result_on' => $paper->show_result_on,
                    'question_paper_name' => $paper->solved_questions['name'],
                ];
                // Second: We need to categorize all the papers according to the conditions.
                // Condition 1: If start date is NULL then student can give test paper at any time.
                // Condition 2: If today's date in greater than start date and less than end date.
                // Condition 3: If retest is set to 1, then student can give test paper within the given date range.
                $today = date('Y-m-d');
                // Start Condition 1

                if ($paper->start_date === null && $paper->attempted_on === null) {
                    $response['manipulated']['can_take_test'][$key][$paper->id] = $defaultValue;
                } // Start Condition 2
                else if ((($paper->start_date <= $today) && ($today <= $paper->end_date)) && $paper->attempted_on === null) {
                    $response['manipulated']['can_take_test'][$key][$paper->id] = $defaultValue;
                } // Start Condition 3
                else if ($paper->can_restest &&
                    (($paper->start_date <= $today) && ($today <= $paper->end_date)) &&
                    $paper->attempted_on === null) {
                    $response['manipulated']['can_take_test'][$key][$paper->id] = $defaultValue;
                } else if ($paper->attempted_on !== null) {
                    $response['manipulated']['test_taken'][$key][$paper->id] = $defaultValue;
                }
            }
        }
        return $response;
    }

    public function saveStudent($request)
    {
        if ($request) {

        }
    }

    /**
     * @param array $request
     * @return array
     */
    private function saveFields($request): array
    {
        return [
            'name'=> $request->name,
            'email' => $request->email,
            'password' => Hash::make(123456789),
            'aadhaar' => $request->aadhaar,
            'board_id' => $request->board_id,
            'standard_id' => $request->standard_id,
            'batch_id' => $request->batch_id,
            'course_id' => $request->course_id,
            'mobile' => $request->mobile,
            'alt_mobile' => $request->alt_mobile,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'permanent_address' => $request->permanent_address,
            'address' => $request->address,
        ];
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(queueable(function ($student)
        {
            //First we need to check if parent information is already available?
            //If yes use that selected parent_id
            $studentParent = StudentParent::firstOrCreate(
                ['parent_email' => $student['father_email']],
                [
                    'parent_email' => $student['father_email'],
                    'parent_password' => Hash::make(123456789),
                    'parent_aadhaar_number' => $student['parent_aadhaar_number'],
                    'mother_name' => $student['mother_name'],
                    'mother_email' => $student['mother_email'],
                    'mother_mobile' => $student['mother_mobile'],
                    'mother_qualification' => $student['mother_qualification'],
                    'mother_occupation' => $student['mother_occupation'],
                    'father_name' => $student['father_name'],
                    'father_email' => $student['father_email'],
                    'father_mobile' => $student['father_mobile'],
                    'father_qualification' => $student['father_qualification'],
                    'father_occupation' => $student['father_occupation'],
                ]
            );
        }));

        static::created(queueable(function ($student)
        {
            
        }));
    }
}
