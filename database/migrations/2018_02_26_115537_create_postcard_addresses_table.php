<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostcardAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcard_addresses', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('postcard_id')->nullable();
            $table->unsignedInteger('address_id');
            $table->enum('type', ['sender', 'reciever']);
            $table->timestamps();

            $table->foreign('postcard_id')->references('id')->on('postcards')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postcard_addresses');
    }
}
