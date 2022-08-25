<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("users")->insert([
            'name' => 'César Obed Figueroa Luna',
            'email' => 'test@test.com',
            'password' => bcrypt('secret'),
            'phone' => '0011223344',
            'role' => 'Administrador',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
