<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = array(
                                'parent_id',
                                'question', 
                                'description', 
                                'marks', 
                                'negative_marks', 
                                'board_id', 
                                'standard_id', 
                                'note', 
                                'difficulty_level_id', 
                                'type_id',
                                'language_id',
                                'subject_id',
                                'chapter_id',
                                'topic_id',
                                'created_by', 
                                'updated_by');

    protected $searchable = [
        'question',
    ];

    protected $sortable = [
        'id',
        'question',
    ];

    public function languages() {
        return $this->belongsTo(Language::class);
    }

    public function question_type() {
        return $this->belongsTo(QuestionType::class, 'type_id');
    }

    public function standard() {
        return $this->belongsTo(Standard::class);
    }

    public function board() {
        return $this->belongsTo(Board::class);
    }

    public function difficulty_level() {
        return $this->belongsTo(QuestionDifficultyLevel::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function chapter() {
        return $this->belongsTo(Chapter::class);
    }

    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    public function creator() {
        return $this->belongsTo(User::class);
    }

    public function updator() {
        return $this->belongsTo(User::class);
    }

    public function scopeRoot($query) {
        $query->whereNull('parent_id');
    }
    public function questions() {
        return $this->hasMany(Question::class, 'parent_id');
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

}
