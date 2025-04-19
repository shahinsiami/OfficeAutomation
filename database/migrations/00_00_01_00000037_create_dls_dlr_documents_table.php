<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDlsDlrDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dls_dlr_documents', function (Blueprint $table) {
            $table->integer('dls_dlr_id')->unsigned();
            $table->foreign('dls_dlr_id')->references('id')->on('dls_dlrs')->onDelete('cascade');
            $table->integer('document_id')->unsigned();
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->primary(['document_id','dls_dlr_id']);
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
        Schema::dropIfExists('dls_dlr_documents');
    }
}
