<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StarReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_review', function (Blueprint $table) {
            $table->increments('star_review_id');
            $table->decimal('star_review_1', 1, 0);
            $table->decimal('star_review_2', 1, 0);
            $table->decimal('star_review_3', 1, 0);
            $table->decimal('star_review_4', 1, 0);
            $table->decimal('star_review_5', 1, 0);
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
        Schema::dropIfExists('star_review');
    }
}
