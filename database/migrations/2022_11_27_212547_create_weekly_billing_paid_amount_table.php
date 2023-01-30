<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyBillingPaidAmountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_billing_paid_amount', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('bill_no')->nullable();
            $table->string('amount')->nullable();
            $table->string('bill_period')->nullable();
            $table->string('from_to_date')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weekly_billing_paid_amount');
        Schema::table('weekly_billing_paid_amount', function (Blueprint $table) {
            $table->dropForeign('weekly_billing_paid_amount_customer_id_foreign');
        });
    }
}
