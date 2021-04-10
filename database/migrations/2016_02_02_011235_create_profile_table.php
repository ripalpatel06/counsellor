<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender', 1)->nullable();
            $table->integer('views')->default(0);
            $table->integer('denomination_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::table('profile', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });


        Schema::table('profile', function($table) {
            $table->foreign('denomination_id')->references('id')->on('denomination');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile');
    }
}
