<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * The attributes that are searchable.
     * 
     * @var array
     */
    protected $searchable = [
        'name',
        'email',
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
    
    public function profile_user() 
    {
        return $this->hasOne(ProfileUser::class);
    }

    public function courses() 
    {
        return $this->hasMany(Course::class, 'created_by');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'created_by');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'created_by');
    }
}
