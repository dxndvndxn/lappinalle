<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table){
            $table->bigIncrements('orders_id');
            $table->unsignedInteger('LappiUsers_id')->nullable();
            $table->foreign('LappiUsers_id')->references('LappiUsers_id')->on('LappiUsers')->onDelete('cascade');
            $table->string('orders_name', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_email', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_city', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_tel', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_street', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_house', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_apart', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_corps', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_indexPost', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_deliveryName', 255)->collation('utf8_general_ci')->nullable();
            $table->string('orders_korzina', 255)->collation('utf8_general_ci');
            $table->string('orders_status', 255)->collation('utf8_general_ci');
            $table->date('orders_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
