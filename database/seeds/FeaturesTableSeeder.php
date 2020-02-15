<?php

use Illuminate\Database\Seeder;
use App\Feature;

class FeaturesTableSeeder extends Seeder
{

    public function run()
    {
        factory(Feature::class, 100)->create();
    }
}
