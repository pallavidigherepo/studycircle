<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use App\Models\Chapter;

class Topic extends Model
{
    use HasFactory;
    use HasTags;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subjects';

    protected $guarded = [];

    protected $fillable = array(
        'label', 
        'description', 
        'icon', 
        'language_id', 
        'parent_id',
        'board_id', 
        'standard_id',  
        'created_by', 
        'updated_by'
    );

    protected $searchable = [
        'label',
        'icon',
    ];

    protected $sortable = [
        'id',
        'label',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'parent_id')->where('parent_id', '!=', null);
    }


    public function chapters() {
        return $this->belongsTo(Chapter::class)->with('chapters')->where('parent_id', '!=', null);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'parent_id')->where('parent_id', '!=', null);
    }
}
