<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlsFlrAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fls_flr_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fls_flr_id')->unsigned();
            $table->foreign('fls_flr_id')->references('id')->on('fls_flrs')->onDelete('cascade');
            $table->text('file');
            $table->string('extension');
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
        Schema::dropIfExists('fls_flr_attachments');
    }
}
