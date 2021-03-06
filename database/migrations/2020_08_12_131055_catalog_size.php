<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatalogSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_size', function(Blueprint $table){
            $table->bigIncrements('catalog_size_id');
            $table->integer('catalog_size_amount');
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->unsignedInteger('sizes_id')->nullable();
            $table->foreign('sizes_id')->references('sizes_id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_size');
    }
}
