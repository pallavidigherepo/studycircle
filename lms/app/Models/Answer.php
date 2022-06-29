<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $fillable = array('question_id', 'answer', 'is_correct', 'created_by', 'updated_by');

    /**
     * Get the post that owns the comment.
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'id');
    }
}
