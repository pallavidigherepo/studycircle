<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            //$table->integer('user_id');

            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('mobile_number')->nullable();
            $table->string('avatar')->nullable();
            $table->string('designation')->nullable();
            $table->string('social_facebook_link')->nullable();
            $table->string('social_linkedin_link')->nullable();
            $table->string('social_twitter_link')->nullable();
            $table->string('social_instagram_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
