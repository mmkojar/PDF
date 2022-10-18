<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGhabhanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ghabhan_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('processing_id')->unsigned()->nullable();
            $table->bigInteger('medical_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('product_stock_id')->unsigned()->nullable();
            $table->string('product_no')->nullable();
            $table->date('processing_date')->nullable();
            $table->date('medical_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('send_to_salves_or_not')->nullable();
            $table->string('salve_name')->nullable();
            $table->string('salve_location')->nullable();
            $table->date('salves_date')->nullable();
            $table->date('back_to_mumbai_date')->nullable();
            $table->enum('status',['inactive', 'salves', 'mumbai','pending']);
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
        Schema::dropIfExists('ghabhan_detail');
    }
}
