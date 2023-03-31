<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * This class is QuestionType model class with related functions and variables.
 *
 * @package Meritest_LMS_User_Model
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 */
class QuestionType extends Model
{
    use HasFactory;

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
