<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwapedBooksTable extends Migration
{
    public function up()
    {
        Schema::create('swaped_books', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('swapID');
            $table->char('book', 20);
            //$table->unsignedInteger('featureID');
            $table->enum('type',['Entrante','Saliente']);
            $table->enum('status',['Sin Registro','Registrado']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('swaped_books');
    }
}
