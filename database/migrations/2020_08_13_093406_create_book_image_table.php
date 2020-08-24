<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->unsignedBigInteger('book_id');
            $table->string('image_type');
            $table->string('book_image');
            $table->timestamps();
            $table->foreign('book_id')->references('book_id')->on('book_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_images');
    }
}
