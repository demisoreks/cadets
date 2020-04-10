<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCadetsTable01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cdt_cadets', function (Blueprint $table) {
            $table->integer('created_by')->unsigned()->after('index');
            $table->foreign('created_by')->references('id')->on('acc_employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cdt_cadets', function (Blueprint $table) {
            //
        });
    }
}
