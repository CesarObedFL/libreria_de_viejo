<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysTable extends Migration
{

    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userID');
            $table->date('date');
            $table->unsignedDecimal('amount',5,2);
            $table->unsignedDecimal('owed',5,2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
