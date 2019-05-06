<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{

    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->char('ISBN', 15)->unique(); // PK necesita
            $table->string('title',100);
            $table->string('author',50);
            $table->string('editorial',50);
            $table->unsignedInteger('classification'); // FK
            $table->string('genre',20)->nullable();
            $table->string('collection',20)->nullable();
            // BOOK FEATURES
            $table->string('edition',20);
            $table->string('conditions',20);
            $table->unsignedInteger('location');
            $table->enum('place', ['Libreria', 'Almacén', 'Exhibición', 'Bazar']); // lugar donde se encuentra actualmente el libro
            $table->unsignedDecimal('price',5,2);
            $table->unsignedInteger('borrowedbooks')->default(0); // <-- ADDED
            $table->unsignedInteger('stock');
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
