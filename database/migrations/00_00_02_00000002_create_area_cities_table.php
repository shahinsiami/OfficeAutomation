<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('area_state_id')->unsigned();
            $table->foreign('area_state_id')->references('id')->on('area_states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_cities');
    }
}
