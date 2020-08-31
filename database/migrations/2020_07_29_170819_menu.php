<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Menu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function(Blueprint $table){
            $table->tinyIncrements('menu_id');
            $table->unsignedTinyInteger('menu_lvlmenu');
            $table->unsignedTinyInteger('sex_id')->nullable();
            $table->foreign('sex_id')->references('sex_id')->on('sex')->onDelete('cascade');
            $table->unsignedTinyInteger('categories_id')->nullable();
            $table->foreign('categories_id')->references('categories_id')->on('categories')->onDelete('cascade');
            $table->unsignedTinyInteger('departments_id')->nullable();
            $table->foreign('departments_id')->references('departments_id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
