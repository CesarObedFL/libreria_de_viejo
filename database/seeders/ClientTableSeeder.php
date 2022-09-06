<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use App\Models\Client;

class ClientTableSeeder extends Seeder
{
    public function run()
    {
    	Client::create([
            'name' => 'Público General',
            'email' => 'publico@test.com',
            'phone' => '1111111111',
            'interests' => 'todos',
            'type' => '2'
        ]);

        //factory(Client::class,5)->create();
    }
}
