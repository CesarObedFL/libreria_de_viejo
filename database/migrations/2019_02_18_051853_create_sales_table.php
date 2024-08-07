<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{

    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained();
            //$table->unsignedInteger('product'); // plantID or ISBN
            $table->char('product_id', 20);
            $table->unsignedInteger('amount'); 
            $table->decimal('price', total: 6, places: 2); 
            $table->unsignedInteger('discount');
            $table->enum('type', [ 'Libro', 'Planta' ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
