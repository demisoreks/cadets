<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCadetsTable05 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cdt_cadets', function (Blueprint $table) {
            $table->dropColumn('check_identity');
            $table->dropColumn('check_certification');
            $table->dropColumn('check_height');
            $table->dropColumn('check_test');
            $table->renameColumn('height', 'height_ft');
            $table->integer('height_in')->after('height');
            $table->renameColumn('comment', 'comment_before');
            $table->text('comment_after', 200)->after('comment');
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
