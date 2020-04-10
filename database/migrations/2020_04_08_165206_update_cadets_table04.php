<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCadetsTable04 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cdt_cadets', function (Blueprint $table) {
            $table->string('check_identity', 1)->nullable()->after('index');
            $table->string('check_certification', 1)->nullable()->after('check_identity');
            $table->string('check_height', 1)->nullable()->after('check_certification');
            $table->string('check_test', 1)->nullable()->after('check_height');
            $table->text('comment', 200)->nullable()->after('status');
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
