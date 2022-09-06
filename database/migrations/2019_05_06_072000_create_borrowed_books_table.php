<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowedBooksTable extends Migration
{
    public function up()
    {
        Schema::create('borrowed_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_id')->constrained();
            $table->foreignId('book_id')->constrained();
            //$table->unsignedInteger('featureID');
            $table->unsignedInteger('amount');
            $table->enum('status', [ 'Activo', 'Entregado' ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowed_books');
    }
}
