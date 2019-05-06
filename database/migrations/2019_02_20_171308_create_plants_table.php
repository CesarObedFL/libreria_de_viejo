<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{

    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30);
            $table->unsignedDecimal('price',5,2);
            $table->string('image',30)->nullable();
            $table->string('tips',50);
            $table->unsignedInteger('stock');
            $table->unsignedInteger('classification');
        });
    }

    public function down()
    {
        Schema::dropIfExists('plants');
    }
}
