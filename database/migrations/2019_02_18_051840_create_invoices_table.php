<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{

    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('date');
            $table->enum('shift', [ 'M', 'V', 'S', 'D' ]);
            $table->foreignId('client_id')->constrained(); 
            $table->decimal('subtotal', total: 8, places: 2); 
            $table->decimal('total',  total: 8, places: 2); 
            $table->decimal('received', total: 8, places: 2); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
