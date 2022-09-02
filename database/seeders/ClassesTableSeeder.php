<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classification;

class ClassesTableSeeder extends Seeder
{
    public function run()
    {
        /*DB::table("classifications")->insert([
            'clase' => str_random(10),
            'ubicacion' => str_random(10),
            'tipo' => 1,
        ]);*/
    	factory(Classification::class, 15)->create();
    }
}
