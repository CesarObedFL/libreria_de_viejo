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
            $table->unsignedDecimal('subtotal', 8, 2);
            $table->unsignedDecimal('total', 8, 2);
            $table->unsignedDecimal('received', 8, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
