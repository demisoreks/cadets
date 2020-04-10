<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdt_cadets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('surname', 100);
            $table->date('date_of_birth');
            $table->string('gender', 1);
            $table->bigInteger('state_of_origin')->unsigned();
            $table->foreign('state_of_origin')->references('id')->on('cdt_states');
            $table->integer('height')->nullable();
            $table->string('qualification', 100);
            $table->string('phone1', 20);
            $table->string('phone2', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('home_address', 500);
            $table->decimal('entrance_score', 10, 2);
            $table->decimal('entrance_pass_mark', 10, 2);
            $table->string('admission_status', 1);
            $table->bigInteger('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('cdt_courses');
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
        Schema::dropIfExists('cdt_cadets');
    }
}
