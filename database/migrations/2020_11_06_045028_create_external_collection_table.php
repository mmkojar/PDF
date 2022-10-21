<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_collection', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            // $table->string('party_name')->nullable();
            // $table->string('ext_party_name')->nullable();
            $table->string('morning')->nullable();
            $table->string('evening')->nullable();
            // $table->string('total_given_taken')->nullable();
            // $table->string('rate')->nullable();
            $table->date('date')->nullable();
            $table->string('total_litres')->nullable();
            // $table->string('amount_paid')->nullable();
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
        Schema::dropIfExists('external_collection');
    }
}
