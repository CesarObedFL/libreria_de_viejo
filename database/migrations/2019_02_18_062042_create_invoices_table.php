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
            $table->enum('turn', ['M','T','S','D']);
            $table->unsignedInteger('clientID'); // FK
            $table->unsignedDecimal('subTotal',5,2);
            $table->unsignedDecimal('total',5,2);
            $table->unsignedDecimal('received',5,2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
