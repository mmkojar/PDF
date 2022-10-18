<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferSalveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_salve', function (Blueprint $table) {
            $table->id();          
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('product_stock_id')->unsigned()->nullable();
            $table->string('salve_name')->nullable();
            $table->string('location')->nullable();  
            $table->date('date')->nullable();      
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
        Schema::dropIfExists('transfer_salve');
    }
}
