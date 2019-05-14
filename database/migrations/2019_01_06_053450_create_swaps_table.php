<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwapsTable extends Migration
{

    public function up()
    {
        Schema::create('swaps', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->unsignedInteger('userID');
            $table->unsignedInteger('incoming');
            $table->unsignedInteger('outcoming');
            $table->unsignedDecimal('amounttopay',6,2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('swaps');
    }
}
