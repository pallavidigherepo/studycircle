<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This class is FeeStructure model class with all fees management related functions and variables.
 *
 * @package Meritest_LMS_FeeStructure_Model
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/fee_structures
 */
class FeeStructure extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'standard_id',
        'batch_id',
        'fee_category_id',
        'amount',
        'created_by',
        'updated_by',
    ];

}
