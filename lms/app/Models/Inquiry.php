<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unique_code',
        'standard_id',
        'batch_id',
        'course_id',
        'inquiry_status_id',
        'inquiry_source_id',
        'inquiry_closing_reason',
        'student_name',
        'student_gender',
        'student_dob',
        'inquiry_date',
        'assigned_to',
        'contact_name',
        'contact_email',
        'contact_mobile',
        'reminder_count',
        'enquired_through',
        'created_by',
        'updated_by',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'unique_code',
    ];


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
    public function source(): BelongsTo
    {
        return $this->belongsTo(InquirySource::class, 'inquiry_source_id');
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(InquiryStatus::class, 'inquiry_status_id');
    }

    /**
     * @return BelongsTo
     */
    public function assigned(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * @return BelongsTo
     */
    public function followup_type(): BelongsTo
    {
        return $this->belongsTo(InquiryFollowupType::class, 'inquiry_followup_type_id');
    }
}
