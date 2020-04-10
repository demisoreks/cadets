<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdt_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cadet_id')->unsigned();
            $table->foreign('cadet_id')->references('id')->on('cdt_cadets');
            $table->bigInteger('assessment_id')->unsigned();
            $table->foreign('assessment_id')->references('id')->on('cdt_assessments');
            $table->boolean('checked')->default(false);
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
        Schema::dropIfExists('cdt_checks');
    }
}
