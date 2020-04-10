<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdt_exam', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cadet_id')->unsigned();
            $table->foreign('cadet_id')->references('id')->on('cdt_cadets');
            $table->bigInteger('metric_id')->unsigned();
            $table->foreign('metric_id')->references('id')->on('cdt_metrics');
            $table->integer('score');
            $table->integer('percentage');
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
        Schema::dropIfExists('cdt_exam');
    }
}
