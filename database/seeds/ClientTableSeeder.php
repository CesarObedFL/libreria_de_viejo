<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientTableSeeder extends Seeder
{
    public function run()
    {
        factory(Client::class,5)->create();
    }
}
