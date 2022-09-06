<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{

    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained();
            $table->enum('type', [ 'Recibida', 'Realizada' ]);
            $table->unsignedInteger('amount');
            $table->date('date');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('classification_id')->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
