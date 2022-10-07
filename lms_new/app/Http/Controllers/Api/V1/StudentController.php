<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\StudentPaper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 *
 */
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;
        $batch = $request->input('batch_id') ?? null;
        $course = $request->input('course_id') ?? null;
        if (!$batch && !$course) {
            return StudentResource::collection(
                Student::when(request('search'), function ($query) {
                    $query->where('name', 'like', '%'. request('search'). '%');
                })

                    ->orderBy($field, $order)
                    ->paginate($perPage)
            );
        } else {
            return StudentResource::collection(
                Student::when(request('search'), function ($query) {
                    $query->where('name', 'like', '%'. request('search'). '%');
                })
                    ->where('batch_id', $batch)
                    ->where('course_id', $course)
                    ->orderBy($field, $order)
                    ->paginate($perPage)
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudentRequest $request
     * @return Response
     * @throws \Exception
     */
    public function store(StoreStudentRequest $request)
    {
        if ($request->validated()) {
            $studentModel = new Student();
            $student = Student::create($studentModel->saveFields($request));

            $student->roll_number = generate_student_roll_number();

            // Check if image was given and save on local file system
            if (isset($request->avatar)) {
                if ($request->avatar) {
                    $absolutePath = public_path($request->avatar);
                    File::delete($absolutePath);
                }
                $student->avatar  = save_image($request->avatar, 'students');
            }

            $student->save();

            $response = [
                'success' => true,
                'message' => 'Student created successfully.',
                'student' => $student,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Student  $student
     * @return array
     */
    public function show(Student $student) :array
    {
        $studentModel = new Student();
        // We need manipulated data of student so that he/she cannot do any kind of cheating.
        return $studentModel->manipulateStudentInfo(new StudentResource(Student::findOrFail($student->id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return Response
     * @throws \Exception
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        if ($request->validated()) {
            $studentModel = new Student();
            $student->update($studentModel->saveFields($request));

            // Check if image was given and save on local file system
            if (isset($request->avatar)) {
                if ($student->avatar) {
                    $absolutePath = public_path($student->avatar);
                    File::delete($absolutePath);
                }
                $student->avatar  = save_image($request->avatar, 'students');;
            }

            $student->save();

            $response = [
                'success' => true,
                'message' => 'Student created successfully.',
                'student' => $student,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($student->avatar) {
            $absolutePath = public_path($student->avatar);
            File::delete($absolutePath);
        }
        if ($student->delete()) {
            $response = [
                'success' => true,
                'message' => 'Student deleted successfully.',
            ];
        }
        return response()->json($response);
    }
}
