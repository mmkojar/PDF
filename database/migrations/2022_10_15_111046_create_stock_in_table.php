<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_in', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id')->unsigned();
            $table->string('party_name')->nullable();
            $table->string('unit')->nullable();
            $table->bigInteger('qty',20)->unsigned();
            $table->string('rate')->nullable();
            $table->string('total_amount')->nullable();
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
        Schema::dropIfExists('stock_in');
        Schema::table('stock_in', function (Blueprint $table) {
            $table->dropForeign('stock_in_item_id_foreign');
        });
    }
}
