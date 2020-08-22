<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('users_id');
            $table->string('users_name')->collation('utf8_general_ci')->nullable($value = f);
//            $table->string('users_surname')->collation('utf8_general_ci')->nullable();
            $table->string('users_email')->unique();
            $table->timestamps();
//            $table->timestamp('users_email_verified_at')->nullable();
            $table->string('users_password');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
