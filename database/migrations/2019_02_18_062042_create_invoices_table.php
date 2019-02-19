<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{

    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id'); // PK
            $table->unsignedInteger('userID'); // FK
            $table->enum('turn', ['M','T','S','D']);
            $table->unsignedInteger('clientID'); // FK
            $table->float('subTotal');
            $table->float('total');
            $table->float('received');
            $table->timestamps(); // fecha
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
