<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id('OptionID'); // Assuming OptionID is the primary key and auto-incrementing
            $table->unsignedBigInteger('QuestionID');
            $table->text('OptionText');
            $table->string('SkinTypeEffect')->nullable();
            $table->string('SeverityEffect')->nullable();
            $table->integer('Score')->nullable();
            // No timestamps()

            $table->foreign('QuestionID')->references('QuestionID')->on('questions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('options');
    }
}