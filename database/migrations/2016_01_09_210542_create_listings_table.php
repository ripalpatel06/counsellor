<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary(['id']);
            $table->string('name');
            $table->string('postal_code');
            $table->string('latitude', 12);
            $table->string('longitude', 12);
            $table->boolean('location_verified')->default(false);
            $table->boolean('published')->default(false);
            $table->integer('views')->default(0);
            $table->timestamps();
        });

        Schema::table('listings', function($table) {
            $table->foreign('id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('listings');
    }
}
