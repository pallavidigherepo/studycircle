<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['site_tile', 'site_meta', 'logo', 'address', 'contact_number', 'contact_email'];
}
