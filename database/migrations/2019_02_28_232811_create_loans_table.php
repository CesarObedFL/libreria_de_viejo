<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{

    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('amount');
            $table->date('outDate');
            $table->date('inDate');
            $table->unsignedInteger('clientID');
            $table->unsignedInteger('userID');
            $table->enum('status',['Activo','Entregado'])->default('Activo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
