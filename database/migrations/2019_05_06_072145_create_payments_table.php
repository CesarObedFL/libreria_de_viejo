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
            $table->decimal('amount', total: 8, places: 2);
            $table->decimal('owed', total: 8, places: 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('Payments');
    }
}
