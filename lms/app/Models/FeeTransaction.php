<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * This class is FeeTransaction model class with all fees management related functions and variables.
 *
 * @package Meritest_LMS_FeeTransaction_Model
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/fee_transactions
 */
class FeeTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fee_id',
        'fee_structure_id',
        'parent_id',
        'amount',
        'created_by',
        'updated_by',
    ];
}
