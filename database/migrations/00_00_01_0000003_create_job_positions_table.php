<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('job_hierarchical_id')->unsigned();
            $table->foreign('job_hierarchical_id')->references('id')->on('job_hierarchicals')->onDelete('cascade');
            $table->integer('job_classification_id')->unsigned();
            $table->foreign('job_classification_id')->references('id')->on('job_classifications')->onDelete('cascade');
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
        Schema::dropIfExists('job_positions');
    }
}
