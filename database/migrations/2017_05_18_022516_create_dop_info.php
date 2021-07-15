<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDopInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dop_infos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->boolean('online');
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
        Schema::dropIfExists('dop_infos');
    }
}
