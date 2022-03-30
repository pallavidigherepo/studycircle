<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
    ];
    
    /**
     * The attributes that are searchable.
     * 
     * @var array
     */
    protected $searchable = [
        'name',
        'guard_name',
    ];
    
    /**
     * The attributes that are sortable.
     * 
     * @var array
     */
    protected $sortable = [
        'name',
        'guard_name',
    ];
}
