<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plant;

class PlantsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Plant::class,10)->create();
    }
}
