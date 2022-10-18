<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodAmountPaidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_amount_paid', function (Blueprint $table) {
            $table->id();
            $table->string('party_name');
            // $table->string('item_name');
            $table->string('description');
            $table->string('amount_paid');
            // $table->date('taken_date');
            // $table->date('paid_date');
            $table->string('month');
            $table->date('date');
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
        Schema::dropIfExists('food_amount_paid');
    }
}
