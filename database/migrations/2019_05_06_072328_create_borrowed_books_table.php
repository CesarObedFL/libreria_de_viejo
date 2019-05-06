<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowedBooksTable extends Migration
{
    public function up()
    {
        Schema::create('borrowed_books', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('loanID');
            $table->unsignedInteger('bookID');
            //$table->unsignedInteger('featureID');
            $table->enum('status',['Activo','Entregado']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowed_books');
    }
}
