<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('parent_email')->unique();
            $table->string('parent_password');
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
        Schema::dropIfExists('parents');
    }
}
