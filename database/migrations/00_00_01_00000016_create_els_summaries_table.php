<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElsSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('els_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('els_id')->unsigned();
            $table->foreign('els_id')->references('id')->on('els')->onDelete('cascade');
            $table->string('hint');
            $table->text('summary')->nullable();
            $table->string('subject');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('els_summaries');
    }
}
