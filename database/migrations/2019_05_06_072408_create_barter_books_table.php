<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarterBooksTable extends Migration
{
    public function up()
    {
        Schema::create('barter_books', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('barterID');
            $table->unsignedInteger('bookID');
            //$table->unsignedInteger('featureID');
            $table->enum('type',['Entrante','Saliente']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('barter_books');
    }
}
