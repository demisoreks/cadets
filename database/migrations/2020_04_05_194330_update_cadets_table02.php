<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCadetsTable02 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cdt_cadets', function (Blueprint $table) {
            $table->decimal('entrance_score', 10, 2)->nullable()->change();
            $table->decimal('entrance_pass_mark', 10, 2)->nullable()->change();
            $table->dropColumn('height');
            $table->dropForeign('cdt_cadets_created_by_foreign');
            $table->dropColumn('created_by');
            $table->dropColumn('admission_status');
            $table->string('status', 100)->after('index');
            $table->integer('treated_by')->unsigned()->after('status');
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
