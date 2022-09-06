<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('Payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('date');
            $table->unsignedDecimal('amount', 8, 2);
            $table->unsignedDecimal('owed', 8, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('Payments');
    }
}
