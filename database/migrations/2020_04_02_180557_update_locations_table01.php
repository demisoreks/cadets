<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLocationsTable01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cdt_locations', function (Blueprint $table) {
            $table->bigInteger('state_id')->unsigned()->after('code');
            $table->foreign('state_id')->references('id')->on('cdt_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cdt_locations', function (Blueprint $table) {
            //
        });
    }
}
