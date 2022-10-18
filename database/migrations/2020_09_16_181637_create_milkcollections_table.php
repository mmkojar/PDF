<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilkcollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milkcollections', function (Blueprint $table) {
            $table->id();
            // $table->string('type')->nullable();
            // $table->string('party_name')->nullable();
            $table->string('morning')->nullable();
            $table->string('evening')->nullable();
            $table->string('given')->nullable();
            $table->string('givenreturn')->nullable();            
            $table->string('taken')->nullable();
            $table->string('takenreturn')->nullable();
            $table->string('total_litres')->nullable();
            // $table->bigInteger('total_sold')->nullable();
            // $table->bigInteger('remaining_milk')->nullable();            
            $table->string('grand_total')->nullable();
            $table->date('collection_date')->nullable();    
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
        Schema::dropIfExists('milkcollections');
    }
}
