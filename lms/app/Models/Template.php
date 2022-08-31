<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Template extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $fillable = array(
        'name',
        'description',
        'board_id',
        'standard_id',
        'total_marks',
        'duration',
        'has_section',
        'is_active',
        'sections',
        'total_questions',
        'compulsory_questions',
        'type_id',
        'created_by',
        'updated_by',
    );

    protected $casts = [
        'sections' => 'array'
    ];

    /**
     * @var string[]
     */
    protected $searchable = [
        'name',
        'description'
    ];

    /**
     * @var string[]
     */
    protected $sortable = [
        'id',
        'name',
    ];

    /**
     * @return BelongsTo
     */
    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    /**
     * @return BelongsTo
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
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
