<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{

    public function up() 
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');;
            $table->string('edition', 20);
            $table->string('conditions', 20);
            $table->unsignedInteger('location');
            $table->enum('place', [ 'Libreria', 'Almacén', 'Exhibición', 'Bazar' ]); // lugar donde se encuentra actualmente el libro
            $table->string('language', 20)->default('español');
            $table->unsignedDecimal('price', 6, 2);
            $table->enum('status', [ 'Disponible', 'Prestado' ])->default('Disponible');
            $table->unsignedInteger('stock');
        });
    }

    public function down()
    {
        Schema::dropIfExists('features');
    }
}
