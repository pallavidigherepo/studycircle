<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPapers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_papers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('generated_question_paper_id')->nullable(true);
            $table->unsignedBigInteger('student_id')->nullable(true);
            $table->date('attempted_on')->nullable(true);
            $table->string('total_time')->nullable(true);
            $table->string('total_time_taken')->nullable(true);
            $table->string('total_marks')->nullable(true);
            $table->string('total_marks_scored')->nullable(true);
            $table->json('solved_questions')->nullable(true);

            $table->foreign('generated_question_paper_id')->references('id')->on('generated_question_papers');
            $table->foreign('student_id')->references('id')->on('students');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_papers');
    }
}
