<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatistika extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistikas', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->integer('podryad1')->unsigned()->nullable();
            $table->integer('podryad2')->unsigned()->nullable();
            $table->integer('podryad3')->unsigned()->nullable();
            $table->integer('podryad4')->unsigned()->nullable();
            $table->integer('podryad5')->unsigned()->nullable();
            $table->integer('podryadm')->unsigned()->nullable();
            $table->integer('podryadk')->unsigned()->nullable();
            $table->integer('podryadb')->unsigned()->nullable();
            $table->integer('pop1')->unsigned()->nullable();
            $table->integer('pop2')->unsigned()->nullable();
            $table->integer('pop3')->unsigned()->nullable();
            $table->integer('pop4')->unsigned()->nullable();
            $table->integer('pop5')->unsigned()->nullable();
            $table->integer('popm')->unsigned()->nullable();
            $table->integer('popk')->unsigned()->nullable();
            $table->integer('popb')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistikas');
    }
}
