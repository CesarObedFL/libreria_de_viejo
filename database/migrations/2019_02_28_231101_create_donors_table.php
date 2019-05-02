<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('institution')->nullable();
            $table->string('contact');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('commercialBusiness')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donors');
    }
}
