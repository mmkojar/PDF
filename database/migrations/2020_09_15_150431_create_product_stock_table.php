<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->string('product_no')->nullable();
            $table->bigInteger('location_id')->unsigned()->nullable();
            $table->bigInteger('khilla_no')->nullable();
            $table->bigInteger('extra_khilla_no')->nullable();
            $table->string('gender')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->string('purchase_from')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('party_name')->nullable();
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
        Schema::dropIfExists('product_stock');
    }
}
