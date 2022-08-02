<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
