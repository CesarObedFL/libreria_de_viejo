<?php

use Illuminate\Database\Seeder;
use App\Plant;

class PlantsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Plant::class,10)->create();
    }
}
