<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{

    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->unsignedDecimal('price', 5, 2);
            $table->string('image_path', 30)->nullable();
            $table->string('tips', 50);
            $table->unsignedInteger('stock');
            $table->foreignId('classification_id')->constrained(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('plants');
    }
}
