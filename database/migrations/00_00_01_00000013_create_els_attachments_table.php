<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElsAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('els_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('els_id')->unsigned();
            $table->foreign('els_id')->references('id')->on('els')->onDelete('cascade');
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
        Schema::dropIfExists('els_attachments');
    }
}
