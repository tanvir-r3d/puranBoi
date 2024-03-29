<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_prices', function (Blueprint $table) {
            $table->id('book_price_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('book_purchase_price');
            $table->integer('book_rent_price');
            $table->integer('book_resell_price');
            $table->integer('book_rent_number')->nullable();
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
        Schema::dropIfExists('book_prices');
    }
}
