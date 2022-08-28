<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GenerateQuestionPaper extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
protected $table = 'generated_question_papers';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $fillable = array(
        'name',
        'is_auto',
        'generated_questions',
        'subject_id',
        'chapter_id',
        'topic_id',
        'difficulty_level_id',
        'template_id',
        'created_by',
        'updated_by',
    );

    protected $casts = [
        'generated_questions' => 'array'
    ];

    /**
     * @return BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return BelongsTo
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    /**
     * @return BelongsTo
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(QuestionType::class, 'type_id');
    }

    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function updator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
