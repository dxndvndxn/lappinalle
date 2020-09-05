<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('reviews_id');
            $table->text('reviews_text')->collation('utf8_general_ci');
            $table->date('reviews_created');
            $table->decimal('reviews_star', 1, 0);
            $table->boolean('reviews_available')->default(0);
            $table->unsignedInteger('LappiUsers_id')->nullable();
            $table->foreign('LappiUsers_id')->references('LappiUsers_id')->on('LappiUsers')->onDelete('cascade');
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
