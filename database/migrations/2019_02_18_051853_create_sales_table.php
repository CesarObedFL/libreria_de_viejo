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
            $table->unsignedInteger('productID'); // plantID or ISBN
            $table->unsignedInteger('amount'); 
            $table->unsignedInteger('discount');
            $table->unsignedDecimal('price',6,2);
            $table->enum('type',['Libro', 'Planta']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
