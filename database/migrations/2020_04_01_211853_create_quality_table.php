<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdt_quality', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cadet_id')->unsigned();
            $table->foreign('cadet_id')->references('id')->on('cdt_cadets');
            $table->bigInteger('measure_id')->unsigned();
            $table->foreign('measure_id')->references('id')->on('cdt_measures');
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
        Schema::dropIfExists('cdt_quality');
    }
}
