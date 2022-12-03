<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockAvailableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_available', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id')->unsigned();
            $table->string('unit')->nullable();
            $table->bigInteger('qty',20)->unsigned();
            $table->string('rate')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('stock_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_available');
        Schema::table('stock_available', function (Blueprint $table) {
            $table->dropForeign('stock_available_item_id_foreign');
        });
    }
}
