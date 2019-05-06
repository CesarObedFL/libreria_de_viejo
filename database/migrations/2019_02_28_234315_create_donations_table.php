<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{

    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('donorID');
            $table->enum('type',['Recibida','Realizada']);
            $table->unsignedInteger('amount');
            $table->date('date');
            $table->unsignedInteger('userID');
            $table->string('classification',30);
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
