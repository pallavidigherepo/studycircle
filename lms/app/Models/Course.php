<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;
use App\Models\CoursesType;
use App\Models\Subject;


class Course extends Model
{
    use HasFactory;
    use Taggable;
    

    protected $guarded = [];

    protected $fillable = array('name', 'course_code', 'language_id', 'created_by', 'updated_by');

    protected $searchable = [
        'name',
        'course_code',
    ];

    protected $sortable = [
        'id',
        'name',
        'course_code',
    ];

    /**
     * The roles that belong to the user.
     */
    public function courses_types()
    {
        return $this->belongsToMany(CoursesType::class, 'course_type', 'course_id', 'type_id');
    }
    
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

}
