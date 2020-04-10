<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdt_instructor_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('acc_employees');
            $table->string('first_name', 50);
            $table->string('surname', 50);
            $table->string('phone1', 20);
            $table->string('phone2', 20)->nullable();
            $table->text('address', 500);
            $table->bigInteger('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('cdt_states');
            $table->text('educational', 500)->nullable();
            $table->text('professional', 500)->nullable();
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
        Schema::dropIfExists('cdt_instructor_details');
    }
}
