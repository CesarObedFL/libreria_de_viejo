<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{

    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoiceID'); // FK
            //$table->unsignedInteger('product'); // plantID or ISBN
            $table->char('product', 20);
            $table->unsignedInteger('amount'); 
            $table->unsignedDecimal('price',6,2);
            $table->unsignedInteger('discount');
            $table->enum('type',['Libro', 'Planta']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
