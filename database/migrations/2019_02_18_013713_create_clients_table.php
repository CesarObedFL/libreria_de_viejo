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
            $table->string('email',40)->unique();
            $table->string('phone',10);
            $table->string('interests',50);
            $table->enum('type',['Interno','Externo']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
