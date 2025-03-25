<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id('IngredientID'); // Assuming IngredientID is the primary key and auto-incrementing
            $table->string('IngredientName');
            $table->string('SkinTypeEffect')->nullable();
            $table->string('AcneEffect')->nullable();
            $table->string('DarkSpotsEffect')->nullable();
            $table->string('LargePoresEffect')->nullable();
            $table->text('Description')->nullable();
            // No timestamps()
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}