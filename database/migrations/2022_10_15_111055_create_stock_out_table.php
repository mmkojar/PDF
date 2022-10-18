<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id')->unsigned();
            $table->string('unit')->nullable();
            $table->bigInteger('qty')->unsigned()->nullable();
            $table->string('rate')->nullable();
            $table->string('total_amount')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('stock_out')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_out');
        Schema::table('stock_out', function (Blueprint $table) {
            $table->dropForeign('stock_out_item_id_foreign');
        });
    }
}
