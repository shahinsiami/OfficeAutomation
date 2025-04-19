<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDlsDlrSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dls_dlr_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dls_dlr_id')->unsigned();
            $table->foreign('dls_dlr_id')->references('id')->on('dls_dlrs')->onDelete('cascade');
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
        Schema::dropIfExists('dls_dlr_summaries');
    }
}
