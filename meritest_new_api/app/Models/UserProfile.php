<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mobile_number', 'avatar', 'designation', 'social_facebook_link', 'social_linkedin_link', 'social_twitter_link', 'social_instagram_link'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(App\Models\User::class);
    }
}
