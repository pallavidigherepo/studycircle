<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * This class is ProfileUser model class with all users profile management related functions and variables.
 *
 * @package Meritest_LMS_User_Model
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/profile
 */
class ProfileUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'alt_email',
        'mobile',
        'alt_mobile',
        'address',
        'alt_address',
        'gender',
        'qualification',
        'avatar',
        'designation',
    ];

    protected $searchable = [
        'id',
        'alt_email',
        'mobile',
        'alt_mobile',
        'address',
        'alt_address',
        'gender',
        'qualification',
        'avatar',
        'designation',
    ];

    protected $sortable = [
        'alt_email',
        'gender',
        'designation',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }
}
