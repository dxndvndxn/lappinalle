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
            $table->increments('catalog_size_id');
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
            $table->unsignedSmallInteger('sizes_id')->nullable();
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
