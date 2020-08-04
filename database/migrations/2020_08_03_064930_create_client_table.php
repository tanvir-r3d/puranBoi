<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('client_name',100);
            $table->tinyInteger('client_gender');
            $table->string('client_slug',100);
            $table->string('client_phone',100)->nullable();
            $table->string('client_email')->unique();
            $table->string('client_image')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('present_address');
            $table->date('client_dob');
            $table->string('client_inst');
            $table->string('client_dept');
            $table->string('details')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('clients');
    }
}
