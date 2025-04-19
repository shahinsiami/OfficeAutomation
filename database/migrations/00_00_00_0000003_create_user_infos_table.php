<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->string('birthday')->nullable();
            $table->text('address')->nullable();
            $table->boolean('sex')->nullable();
            $table->integer('degree')->nullable();
            $table->string('signature')->nullable();
            $table->string('photo')->default('/img/adminpanel/client/profile.png');
            $table->string('email')->nullable();
            $table->bigInteger('phonenumber')->unsigned()->unique()->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_infos');
    }
}
