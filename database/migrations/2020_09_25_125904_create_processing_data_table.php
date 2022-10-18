<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessingDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processing_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('product_stock_id')->unsigned()->nullable();
            $table->string('product_no')->nullable();
            $table->date('processing_date')->nullable();
            $table->date('actual_or_further_processing_date')->nullable();
            $table->string('is_processed_or_not')->nullable();
            $table->string('note')->nullable();
            $table->integer('no_of_process')->nullable();
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
        Schema::dropIfExists('processing_data');
    }
}
