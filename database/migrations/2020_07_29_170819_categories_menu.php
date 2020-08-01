<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoriesMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_menu', function(Blueprint $table){
            $table->tinyIncrements('categories_menu_id');
            $table->unsignedTinyInteger('categories_menu_lvlmenu');
            $table->boolean('categories_menu_show')->default(1);
            $table->unsignedTinyInteger('sex_id')->nullable();
            $table->foreign('sex_id')->references('sex_id')->on('sex')->onDelete('cascade');
            $table->unsignedTinyInteger('categories_id')->nullable();
            $table->foreign('categories_id')->references('categories_id')->on('categories')->onDelete('cascade');
            $table->unsignedTinyInteger('season_id')->nullable();
            $table->foreign('season_id')->references('season_id')->on('season')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_menu');
    }
}
