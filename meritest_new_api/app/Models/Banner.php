<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class Banner extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['banner_category_id', 'name', 'description', 'image'];


    /**
     * @return BelongsTo
     */
    public function banner_category(): BelongsTo
    {
        return $this->belongsTo(BannerCategory::class);
    }
}
