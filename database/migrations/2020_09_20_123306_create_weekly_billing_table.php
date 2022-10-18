<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_billing', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('bill_no')->nullable();
            $table->string('bill_period')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('month')->nullable();
            $table->string('total_litres')->nullable();
            $table->string('amount')->nullable();
            $table->string('previous_balance')->nullable();
            $table->string('total_amount')->nullable(); 
            $table->string('amount_paid')->nullable();
            $table->string('adjusted')->nullable();
            $table->string('pending_amount')->nullable();
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
        Schema::dropIfExists('weekly_billing');
    }
}
