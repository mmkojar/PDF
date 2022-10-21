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
            $table->string('milk_rate',20)->nullable();
            $table->string('morning',20)->nullable();
            $table->string('evening',20)->nullable();
            $table->bigInteger('mobile_no',15)->nullable();
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
