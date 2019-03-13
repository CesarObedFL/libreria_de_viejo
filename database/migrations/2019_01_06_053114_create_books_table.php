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
            $table->string('title');
            $table->string('author');
            $table->string('editorial');
            $table->unsignedInteger('classification'); // FK
            $table->string('genre')->nullable();
            $table->string('collection')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
