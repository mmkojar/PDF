<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCheckupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_checkup', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('processing_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('product_stock_id')->unsigned()->nullable();
            $table->string('product_no')->nullable();
            $table->date('processing_date')->nullable();
            $table->date('medical_date')->nullable();
            $table->date('actual_medical_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('is_pregnant_or_not')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('medical_checkup');
    }
}
