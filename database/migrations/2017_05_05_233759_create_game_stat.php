<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameStat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_stats', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->integer('day1')->nullable()->unsigned();
            $table->integer('day2')->nullable()->unsigned();
            $table->integer('day3')->nullable()->unsigned();
            $table->integer('num_hod')->unsigned();
            $table->integer('points')->unsigned();
            $table->integer('mimo')->nullable()->unsigned();
            $table->integer('daymimo')->nullable()->unsigned();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_stats');
    }
}
