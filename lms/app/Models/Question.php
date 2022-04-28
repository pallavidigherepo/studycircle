<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = array('question', 
                                'description', 
                                'board', 
                                'standard', 
                                'note', 
                                'difficulty_level', 
                                'type_id',
                                'language_id',
                                'subject_id',
                                'chapter_id',
                                'topic_id',
                                'created_by', 
                                'updated_by');

    protected $searchable = [
        'question',
        'board',
        'standard',
        'note',
    ];

    protected $sortable = [
        'id',
        'question',
        'board',
        'standard',
        'note',
    ];

    public function languages() {
        return $this->hasOne(Language::class);
    }

    public function question_type() {
        return $this->hasOne(QuestionType::class);
    }

    public function difficulty_level() {
        return $this->hasOne(QuestionDifficultyLevel::class);
    }

    public function subject() {
        return $this->hasOne(Subject::class);
    }

    public function chapter() {
        return $this->hasOne(Chapter::class);
    }

    public function topic() {
        return $this->hasOne(Topic::class);
    }

    public function creator() {
        return $this->hasOne(User::class);
    }

    public function updator() {
        return $this->hasOne(User::class);
    }

}
