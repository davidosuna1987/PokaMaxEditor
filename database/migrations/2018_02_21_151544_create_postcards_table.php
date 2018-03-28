<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcards', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('user_id');
            $table->enum('status', ['SENDED', 'DRAFT'])->default('DRAFT');
            $table->string('product_name');
            $table->integer('signature_width')->nullable();
            $table->string('signature_position')->nullable();
            $table->string('signature_file_path')->nullable();
            $table->integer('company_logo_width')->nullable();
            $table->string('company_logo_position')->nullable();
            $table->string('company_logo_file_path')->nullable();
            $table->string('front_cropped_file_path')->nullable();
            $table->string('front_original_file_path')->nullable();
            $table->string('front_thumbnail_file_path')->nullable();
            $table->text('back_text');
            $table->boolean('show_back_reciever')->default(true);
            $table->string('back_color');
            $table->integer('font_family');
            $table->integer('font_size');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postcards');
    }
}
