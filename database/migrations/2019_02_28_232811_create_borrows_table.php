<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowsTable extends Migration
{

    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('amount_book');
            $table->date('out_date');
            $table->date('in_date');
            $table->foreignId('client_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->decimal('amount', total: 8, places: 2);
            $table->enum('status', [ 'Activo', 'Entregado' ])->default('Activo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrows');
    }
}
