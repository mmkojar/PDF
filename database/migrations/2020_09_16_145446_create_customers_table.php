<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->string('customer_type')->nullable();
            $table->string('bill_period')->nullable();
            $table->string('customer_location')->nullable();
            $table->string('description')->nullable();
            $table->string('milk_rate')->nullable();
            $table->string('morning')->nullable();
            $table->string('evening')->nullable();
            $table->string('mobile_no1')->nullable();
            $table->bigInteger('mobile_no2')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
