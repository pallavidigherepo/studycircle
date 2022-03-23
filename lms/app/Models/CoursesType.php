<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesType extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'description',
        'icon',
    ];

    protected $searchable = [
        'label',
        'description',
    ];

    protected $sortable = [
        'id',
        'label',
        'description',
    ];
    
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

}
