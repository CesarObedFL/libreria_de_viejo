<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{

    public function up() 
    {
        Schema::create('features', function (Blueprint $table) {
            $table->increments('ID'); // PK
            $table->unsignedInteger('bookID');
            $table->string('edition');
            $table->string('conditions');
            $table->enum('place', ['Libreria', 'Almacén', 'Exhibición', 'Bazar']); // lugar donde se encuentra actualmente el libro
            $table->string('language')->default('español');
            $table->float('price');
            $table->enum('status', ['Disponible','Prestado']);
            $table->unsignedInteger('stock');
            $table->foreign('bookID')->references('ID')->on('books')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('features');
    }
}
