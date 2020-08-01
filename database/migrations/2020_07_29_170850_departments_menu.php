<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepartmentsMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments_menu', function(Blueprint $table){
            $table->tinyIncrements('departments_menu_id');
            $table->unsignedTinyInteger('departments_id')->nullable();
            $table->foreign('departments_id')->references('departments_id')->on('departments')->onDelete('cascade');
            $table->unsignedTinyInteger('categories_menu_id')->nullable();
            $table->foreign('categories_menu_id')->references('categories_menu_id')->on('categories_menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments_menu');
    }
}
