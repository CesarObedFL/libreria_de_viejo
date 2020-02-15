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
            $table->date('date');
            $table->enum('turn', ['M','V','S','D']);
            $table->unsignedInteger('clientID'); // FK
            $table->unsignedDecimal('subTotal',8,2);
            $table->unsignedDecimal('total',8,2);
            $table->unsignedDecimal('received',8,2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
