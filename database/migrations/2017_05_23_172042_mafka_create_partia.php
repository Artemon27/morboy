<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MafkaCreatePartia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mafka')->create('partias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('razmer');
            $table->string('igrok1')->nullable();
            $table->string('igrok2')->nullable();
            $table->string('igrok3')->nullable();
            $table->string('igrok4')->nullable();
            $table->string('igrok5')->nullable();
            $table->string('igrok6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mafka')->drop('partias');
    }
}
