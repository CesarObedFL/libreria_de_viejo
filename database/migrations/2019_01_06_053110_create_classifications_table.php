<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassificationsTable extends Migration
{
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->enum('type', [ 'Libro', 'Planta' ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('classifications');
    }
}
