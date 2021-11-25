<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('question')->nullable();
            $table->longText('description')->nullable();
            $table->string('board')->nullable();
            $table->string('standard')->nullable();
            $table->longText('note')->nullable();

            //All the relational fields will come after this.
            $table->unsignedBigInteger('difficulty_level');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('language_id');
            
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('topic_id');

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            
            $table->foreign('difficulty_level')->references('id')->on('question_difficulty_levels');
            $table->foreign('type_id')->references('id')->on('question_types');
            $table->foreign('language_id')->references('id')->on('languages');
            
            $table->foreign('subject_id')->references('id')->on('subjects');            
            $table->foreign('chapter_id')->references('parent_id')->on('subjects');            
            $table->foreign('topic_id')->references('parent_id')->on('subjects');

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');


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
        Schema::dropIfExists('questions');
    }
}
