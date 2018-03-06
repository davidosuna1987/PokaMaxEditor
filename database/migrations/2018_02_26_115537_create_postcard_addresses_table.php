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
            $table->increments('id');
            $table->integer('postcard_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->enum('type', ['sender', 'reciever']);
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
        Schema::dropIfExists('postcard_addresses');
    }
}
