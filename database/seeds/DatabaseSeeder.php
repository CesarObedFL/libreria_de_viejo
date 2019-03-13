<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(ClassesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PlantsTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(FeaturesTableSeeder::class);
    }
}
