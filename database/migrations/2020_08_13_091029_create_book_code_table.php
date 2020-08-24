<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_codes', function (Blueprint $table) {
            $table->id('book_code_id');
            $table->unsignedBigInteger('book_id');
            $table->string('booke_unique_code',100)->unique();
            $table->string('rent_status',100);
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
        Schema::dropIfExists('book_codes');
    }
}
