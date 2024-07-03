<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwapsTable extends Migration
{

    public function up()
    {
        Schema::create('swaps', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('incoming_books');
            $table->unsignedInteger('outgoing_books');
            $table->decimal('amount_to_pay', total: 6, places: 2); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('swaps');
    }
}
