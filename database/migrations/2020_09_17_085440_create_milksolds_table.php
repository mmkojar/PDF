<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilksoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milksolds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            // $table->string('type')->nullable();
            // $table->string('normal_customer_name')->nullable();
            // $table->string('milk_rate',20)->nullable();
            $table->string('morning',20)->nullable();
            $table->string('evening',20)->nullable();
            $table->string('total_litres')->nullable();
            // $table->string('amount_paid')->nullable();
            // $table->string('pending_amount')->nullable();
            $table->string('total_amount')->nullable();
            $table->date('sold_date')->nullable();
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
        Schema::dropIfExists('milksolds');
    }
}
