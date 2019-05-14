<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowsTable extends Migration
{

    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('amountbooks');
            $table->date('outDate');
            $table->date('inDate');
            $table->unsignedInteger('clientID');
            $table->unsignedInteger('userID');
            $table->unsignedDecimal('amount');
            $table->enum('status',['Activo','Entregado'])->default('Activo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrows');
    }
}
