<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function Illuminate\Events\queueable;


/**
 * This class is User model class with all user management related functions and variables.
 *
 * @package Meritest_LMS_User_Model
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/users
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

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

    public function profile_user(): HasOne
    {
        return $this->hasOne(ProfileUser::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'created_by');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'created_by');
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class, 'created_by');
    }

    /**
     * Return all the roles the model has, both directly and via roles.
     */
    public function getAllRoles(): Collection
    {
        /** @var Collection $roles */
        $roles = $this->roles;

        return $roles->sort()->values();
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(queueable(function ($user)
        {
            //When user is created we also need to insert row in profile user
            $profile = [
                'user_id' => $user->id,
                'mobile' => $user->mobile_number,
                'designation' => 'Owner',
            ];
            ProfileUser::create($profile);
        }));
    }
}
