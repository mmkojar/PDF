<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_list', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('eid')->unsigned();
            $table->string('entry',20)->nullable();
            $table->string('per_day_salary')->nullable();
            $table->string('month')->nullable();
            $table->date('date')->nullable();            
            $table->timestamps();

            
            $table->foreign('eid')->references('id')->on('employees')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_list');
        Schema::table('attendance_list', function (Blueprint $table) {
            $table->dropForeign('attendance_list_eid_foreign');
        });
    }
}
