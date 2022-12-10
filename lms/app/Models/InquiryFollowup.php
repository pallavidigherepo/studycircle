<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class InquiryFollowup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inquiry_id',
        'inquiry_status_id',
        'inquiry_followup_type_id',
        'followup_date',
        'followup_time',
        'created_by',
        'updated_by',
    ];

    /**
     * @return HasMany
     */
    public function inquiry_comments() :HasMany
    {
        return $this->hasMany(InquiryComment::class);
    }

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($inquiryFollowup) {
            InquiryComment::create([
                'inquiry_id' => $inquiryFollowup->inquiry_id,
                'comment' => $inquiryFollowup->comment,
                'parent_id' => null,
                'inquiry_followup_id' => $inquiryFollowup->id,
                'inquiry_status_id' => $inquiryFollowup->inquiry_status_id,
                'inquiry_followup_type_id' => $inquiryFollowup->inquiry_followup_type_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        });
    }
}
