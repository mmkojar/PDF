<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salves', function (Blueprint $table) {
            $table->id();            
            $table->string('location')->nullable();            
            $table->string('description')->nullable();  
            $table->string('salve_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->bigInteger('mobile_no')->nullable();
            // $table->bigInteger('no_of_days')->nullable();      
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
        Schema::dropIfExists('salves');
    }
}
