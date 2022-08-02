<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('roll_number')->unique();
            $table->unsignedBigInteger('board_id')->nullable(true);
            $table->unsignedBigInteger('standard_id')->nullable(true);
            $table->unsignedBigInteger('language_id')->nullable(true);
            $table->unsignedBigInteger('course_id')->nullable(true);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile');
            $table->string('alt_mobile')->nullable(true);
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('avatar')->nullable(true);
            $table->date('dob')->nullable(true);
            $table->text('permanent_address')->nullable(true);
            $table->text('address');
            $table->string('mother_name')->nullable(true);
            $table->string('mother_email')->nullable(true);
            $table->string('mother_mobile')->nullable(true);
            $table->string('mother_qualification')->nullable(true);
            $table->string('mother_occupation')->nullable(true);
            $table->string('father_name')->nullable(true);
            $table->string('father_email')->nullable(true);
            $table->string('father_mobile')->nullable(true);
            $table->string('father_qualification')->nullable(true);
            $table->string('father_occupation')->nullable(true);
            $table->string('parent_email');
            $table->string('parent_password');

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('board_id')->references('id')->on('boards');
            $table->foreign('standard_id')->references('id')->on('standards');
            $table->foreign('language_id')->references('id')->on('languages');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
