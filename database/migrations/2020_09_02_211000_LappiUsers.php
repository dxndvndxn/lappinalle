<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LappiUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LappiUsers', function(Blueprint $table){
            $table->increments('LappiUsers_id');
            $table->string('LappiUsers_name', 100)->collation('utf8_general_ci');
            $table->string('LappiUsers_email')->unique();
            $table->string('LappiUsers_password');
            $table->string('LappiUsers_token');
            $table->string('LappiUsers_tel')->nullable();
            $table->string('LappiUsers_sity')->nullable();
            $table->string('LappiUsers_street')->nullable();
            $table->string('LappiUsers_house')->nullable();
            $table->string('LappiUsers_corps')->nullable();
            $table->string('LappiUsers_apart')->nullable();
            $table->string('LappiUsers_ipost')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LappiUsers');
    }
}
