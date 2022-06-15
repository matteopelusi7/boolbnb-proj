<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddApartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_apartment', function (Blueprint $table) {
            $table->unsignedBigInteger('add_id')->nullable();
            $table->unsignedBigInteger('apartment_id')->nullable();

            // add foreign key 
            $table->foreign('add_id')
                ->references('id')
                ->on('adds')
                ->onDelete('cascade');

            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments')
                ->onDelete('cascade');

            $table->primary(['apartment_id','add_id']);
        });
    }   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_apartment');
    }
}
