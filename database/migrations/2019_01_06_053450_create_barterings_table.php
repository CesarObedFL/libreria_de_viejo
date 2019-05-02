<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarteringsTable extends Migration
{

    public function up()
    {
        Schema::create('barterings', function (Blueprint $table) {
            $table->increments('ID');
            $table->date('date');
            $table->unsignedInteger('userID');
            $table->unsignedInteger('in');
            $table->unsignedInteger('out');
            $table->float('amounttopay',5,2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('barterings');
    }
}
