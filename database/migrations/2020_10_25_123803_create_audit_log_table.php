<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('product_stock_id')->unsigned()->nullable();
            $table->string('product_no')->nullable();
            $table->date('processing_date')->nullable();
            $table->date('actual_or_further_processing_date')->nullable();
            $table->string('is_processed_or_not')->nullable();
            $table->string('process_note')->nullable();
            $table->date('medical_date')->nullable();
            $table->date('actual_medical_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('is_pregnant_or_not')->nullable();
            $table->date('back_to_process_date_from_medical')->nullable();
            $table->string('medical_note')->nullable();
            $table->string('salve_name')->nullable();
            $table->string('salve_location')->nullable();
            $table->date('salves_date')->nullable();
            $table->string('back_to_process_note')->nullable();
            $table->date('back_to_process_date')->nullable();
            $table->date('back_to_mumbai_date')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('audit_log');
    }
}
