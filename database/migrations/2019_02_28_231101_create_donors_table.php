<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institution',50)->nullable();
            $table->string('contact',50);
            $table->string('email',50)->nullable();
            $table->string('phone',12)->nullable();
            $table->string('address',50)->nullable();
            $table->string('commercialBusiness',30)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donors');
    }
}
