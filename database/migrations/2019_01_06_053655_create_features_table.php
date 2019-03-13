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
            $table->unsignedInteger('book_id');
            $table->string('edition');
            $table->string('conditions');
            $table->enum('place', ['Libreria', 'Almacén', 'Exhibición', 'Bazar']); // lugar donde se encuentra actualmente el libro
            $table->string('language')->default('español');
            $table->float('price');
            $table->enum('status', ['Disponible','Prestado']);
            $table->unsignedInteger('stock');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('features');
    }
}
