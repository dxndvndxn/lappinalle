<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mainpage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mainpage', function(Blueprint $table){
            $table->tinyIncrements('mainpage_id');
            $table->string('mainpage_name')->nullable();
            $table->string('mainpage_main_img')->nullable();
            $table->string('mainpage_main_h1')->nullable();
            $table->string('mainpage_main_h2')->nullable();
            $table->string('mainpage_main_h3')->nullable();
            $table->string('mainpage_main_but_text')->nullable();
            $table->string('mainpage_main_but_href')->nullable();
            $table->string('mainpage_main_video')->nullable();
            $table->string('mainpage_block_sex')->nullable();
            $table->string('mainpage_block_cat')->nullable();
            $table->string('mainpage_block_dep')->nullable();
            $table->string('mainpage_block_h1')->nullable();
            $table->string('mainpage_block_sale')->nullable();
            $table->string('mainpage_block_price')->nullable();
            $table->string('mainpage_block_but_text')->nullable();
            $table->string('mainpage_block_but_href')->nullable();
            $table->string('mainpage_block_carousel_products_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mainpage');
    }
}
