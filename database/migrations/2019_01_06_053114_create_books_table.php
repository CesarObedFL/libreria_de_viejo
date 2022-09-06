<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->char('ISBN', 20)->unique(); // PK necesita
            $table->string('title', 100);
            $table->string('author', 50);
            $table->string('editorial', 100);
            $table->string('edition', 20); // FEATURE
            $table->string('conditions', 20); // FEATURE
            $table->foreignId('classification_id')->constrained(); 
            $table->unsignedInteger('location'); // FEATURE
            $table->unsignedInteger('stock'); // FEATURE
            $table->unsignedDecimal('price', 6, 2); // FEATURE
            $table->unsignedInteger('borrowed_books')->default(0); // FEATURE
            $table->string('genre', 20)->nullable();
            $table->string('collection', 20)->nullable();
            $table->enum('place', [ 'Libreria', 'Almacén', 'Exhibición', 'Bazar' ]); // FEATURE : lugar donde se encuentra actualmente el libro
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
