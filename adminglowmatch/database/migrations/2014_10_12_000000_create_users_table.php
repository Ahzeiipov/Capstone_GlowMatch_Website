<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('UserID'); // Changed from $table->id() to $table->id('UserID')
            $table->string('UserName'); // Changed from 'name' to 'UserName'
            $table->string('Email')->unique(); // Changed from 'email' to 'Email'
            $table->string('password');
            $table->timestamp('created_at')->nullable(); // Changed to explicitly include created_at
            //Removed email_verified_at, rememberToken, current_team_id, profile_photo_path, updated_at, level
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}