<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lappiusers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lappiusers', function(Blueprint $table){
            $table->increments('lappiusers_id');
            $table->string('lappiusers_name', 100)->collation('utf8_general_ci');
            $table->string('lappiusers_email')->unique();
            $table->string('lappiusers_password');
            $table->string('lappiusers_token');
            $table->string('lappiusers_tel')->nullable();
            $table->string('lappiusers_sity')->nullable();
            $table->string('lappiusers_street')->nullable();
            $table->string('lappiusers_house')->nullable();
            $table->string('lappiusers_corps')->nullable();
            $table->string('lappiusers_apart')->nullable();
            $table->string('lappiusers_ipost')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lappiusers');
    }
}
