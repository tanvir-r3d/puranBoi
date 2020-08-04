<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_docs', function (Blueprint $table) {
            $table->id('client_doc_id');
            $table->unsignedBigInteger('client_id');
            $table->string('client_doc',1000);
            $table->string('doc_type',1000);
            $table->timestamps();

            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_docs');
    }
}
