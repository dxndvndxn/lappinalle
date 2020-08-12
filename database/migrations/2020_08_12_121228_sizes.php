<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function(Blueprint $table){
            $table->smallIncrements('sizes_id');
            $table->string('sizes_shoes', 30)->collation('utf8_general_ci')->nullable();
            $table->string('sizes_clothes', 30)->collation('utf8_general_ci')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sizes');
    }
}
