<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(ClassesTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
