<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElrSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elr_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('elr_id')->unsigned();
            $table->foreign('elr_id')->references('id')->on('elrs')->onDelete('cascade');
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
        Schema::dropIfExists('elr_summaries');
    }
}
