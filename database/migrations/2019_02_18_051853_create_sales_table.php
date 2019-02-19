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
            $table->unsignedInteger('productID'); // FK
            $table->unsignedInteger('amount'); 
            $table->unsignedInteger('discount');
            $table->float('price',5,2);
            //$table->enum('type',['Libros', 'Planta']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
