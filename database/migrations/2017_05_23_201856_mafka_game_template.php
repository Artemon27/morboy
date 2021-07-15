<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MafkaGameTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::connection('mafka')->create('Game_templates', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('rol')->nullable();
            $table->boolean('life')->nullable();
            $table->integer('hod')->nullable();
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
       Schema::connection('mafka')->drop('Game_templates');
    }
}
