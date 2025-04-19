<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIlsIlrSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ils_ilr_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ils_ilr_id')->unsigned();
            $table->foreign('ils_ilr_id')->references('id')->on('ils_ilrs')->onDelete('cascade');
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
        Schema::dropIfExists('ils_ilr_summaries');
    }
}
