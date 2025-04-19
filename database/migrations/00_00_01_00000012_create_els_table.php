<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('els', function (Blueprint $table) {
            $table->increments('id');
            $table->string('receiver');
            $table->dateTime('date_of_letter');
            $table->integer('security');
            $table->integer('type_of_letter');
            $table->integer('letter_priority');
            $table->string('indicator');
            $table->string('registrar');
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
        Schema::dropIfExists('els');
    }
}
