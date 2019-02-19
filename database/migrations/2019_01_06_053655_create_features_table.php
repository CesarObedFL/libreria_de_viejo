<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{

    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->increments('id'); // PK
            //$table->string('ID'); // FK
            //$table->foreign('ID')->references('ID')->on('books')->onDelete('cascade'); // FK = Libro al que pertenece
            $table->char('edition');
            $table->string('conditions');
            $table->enum('place', ['libreria', 'almacén', 'exhibición', 'bazar']); // lugar donde se encuentra actualmente el libro
            $table->string('language');
            $table->float('price');
            $table->enum('status', ['Disponible','Prestado']);
            $table->unsignedInteger('amount');
        });
    }

    public function down()
    {
        Schema::dropIfExists('features');
    }
}
