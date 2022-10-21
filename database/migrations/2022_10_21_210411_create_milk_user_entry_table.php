<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilkUserEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milk_user_entry', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('morning',20)->nullable();
            $table->string('evening',20)->nullable();
            $table->string('total_litres')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('milk_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('milk_user_entry');
        Schema::table('milk_user_entry', function (Blueprint $table) {
            $table->dropForeign('milk_user_entry_user_id_foreign');
        });
    }
}
