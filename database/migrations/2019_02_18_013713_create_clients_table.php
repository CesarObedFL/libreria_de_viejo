<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{

    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',40);
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('interests');
            $table->enum('type',['Interno','Externo']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
