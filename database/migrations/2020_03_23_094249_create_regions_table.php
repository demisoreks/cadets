<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdt_regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->unique('name');
            $table->bigInteger('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('cdt_states');
            $table->boolean('active');
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
        Schema::dropIfExists('cdt_regions');
    }
}
