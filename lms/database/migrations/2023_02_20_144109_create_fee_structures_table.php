<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('standard_id')->nullable();
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->string('admission_prospectus')->nullable();
            $table->string('curriculum_activity')->nullable();
            $table->string('sports_karate_dance_music')->nullable();
            $table->string('term')->nullable();
            $table->string('tuition')->nullable();
            $table->string('books_stationary')->nullable();
            $table->string('uniform_bag')->nullable();
            $table->string('total_school')->nullable();
            $table->string('cultural_activity')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->foreign('standard_id')->references('id')->on('standards');
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('fee_structures');
    }
}
