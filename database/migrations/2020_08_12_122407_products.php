<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table){
            $table->increments('product_id');
            $table->string('product_title', 150)->collation('utf8_general_ci');
            $table->decimal('product_price', 5, 0);
            $table->text('product_description')->collation('utf8_general_ci');
            $table->text('product_img')->collation('utf8_general_ci');
            $table->text('product_video')->nullable()->collation('utf8_general_ci');
            $table->boolean('product_available')->default(1);
            $table->tinyInteger('product_sale')->nullable();
            $table->decimal('product_amount', 7, 0);
            $table->timestamp("added_on");
            $table->unsignedTinyInteger('sex_id')->nullable();
            $table->foreign('sex_id')->references('sex_id')->on('sex')->onDelete('cascade');
            $table->unsignedTinyInteger('categories_id')->nullable();
            $table->foreign('categories_id')->references('categories_id')->on('categories')->onDelete('cascade');
            $table->unsignedTinyInteger('departments_id')->nullable();
            $table->foreign('departments_id')->references('departments_id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
