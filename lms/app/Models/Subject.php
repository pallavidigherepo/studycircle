<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;
use App\Models\Course;

class Subject extends Model
{
    use HasFactory;
    use Taggable;
    
    protected $guarded = [];

    protected $fillable = array('label', 'description', 'icon', 'language_id', 'parent_id', 'created_by', 'updated_by');

    protected $searchable = [
        'label',
        'icon',
    ];

    protected $sortable = [
        'id',
        'label',
    ];

    /**
     * The roles that belong to the user.
     */
    public function courses_subjects()
    {
        return $this->belongsToMany(Course::class, 'course_subject', 'subject_id', 'course_id');
    }
}
