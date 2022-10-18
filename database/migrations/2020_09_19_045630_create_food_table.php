<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('item_name')->nullable();
            $table->string('party_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('total_amount_by_customer')->nullable();
            $table->string('total_amount_by_month')->nullable();
            $table->string('total_amount_paid_by_customer')->nullable();
            $table->string('total_amount_paid_by_month')->nullable();
            // $table->string('amount_paid')->nullable();
            // $table->string('pending_amount')->nullable();
            $table->string('quantity')->nullable();
            $table->string('total_quantity')->nullable();
            $table->date('date')->nullable();
            $table->string('month')->nullable();
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
        Schema::dropIfExists('food');
    }
}
