<?php

use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{

    public function run()
    {
        factory(App\Feature::class, 100)->create();
    }
}
