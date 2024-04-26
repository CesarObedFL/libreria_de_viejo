<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'César Obed Figueroa Luna',
            'email' => 'cesar@test.com',
            'password' => bcrypt('12345678'),
            'phone' => '0011223344',
            'role' => 'Administrador',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
