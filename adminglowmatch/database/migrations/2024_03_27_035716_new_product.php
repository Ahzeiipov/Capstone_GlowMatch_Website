<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('ProductID'); // Assuming ProductID is the primary key and auto-incrementing
            $table->string('ProductName');
            $table->string('SkinType')->nullable(); // Assuming nullable
            $table->string('ConcernType')->nullable(); // Assuming nullable
            $table->string('ProductType')->nullable(); // Assuming nullable
            $table->binary('ProductImage1')->nullable(); // For BLOBs
            $table->binary('ProductImage2')->nullable();
            $table->binary('ProductImage3')->nullable();
            $table->binary('ProductImage4')->nullable();
            $table->binary('ProductImage5')->nullable();
            $table->text('KeyIngredients')->nullable(); // Assuming nullable
            $table->text('ShortDesrciption')->nullable();
            $table->longText('MoreDescription')->nullable(); // Assuming nullable
            $table->longText('ProductDetails')->nullable(); // Assuming nullable
            $table->binary('TextureImage')->nullable(); // For BLOBs
            $table->text('ProductBenefits')->nullable();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}