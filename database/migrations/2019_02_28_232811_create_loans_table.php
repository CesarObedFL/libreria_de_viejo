<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{

    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('amount');
            $table->date('departureDate');
            $table->date('returnDate');
            $table->unsignedInteger('id_client');
            $table->unsignedInteger('id_user');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
