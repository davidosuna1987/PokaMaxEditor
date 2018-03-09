<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('zip_code');
            $table->string('company')->nullable();
            $table->string('title')->nullable();
            $table->string('name');
            $table->string('surnames')->nullable();
            $table->string('birthday')->nullable();
            $table->unsignedInteger('address_list_id')->nullable();
            $table->timestamps();

            $table->foreign('address_list_id')->references('id')->on('address_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
