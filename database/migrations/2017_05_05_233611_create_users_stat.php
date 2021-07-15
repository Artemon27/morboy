<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersStat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('max_result')->unsigned();
            $table->integer('last_result')->unsigned();
            $table->integer('all_result')->unsigned();
            $table->integer('allpoints')->unsigned();
            $table->integer('hod')->unsigned();
            $table->integer('games')->unsigned();
            $table->integer('klad')->unsigned();
            $table->integer('bomb')->unsigned();
            $table->char('last');
            $table->integer('num_last')->unsigned();
            $table->boolean('dostup');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_stats');
    }
}
