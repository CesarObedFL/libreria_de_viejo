<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    public function run()
    {
        /*DB::table("classifications")->insert([
            'clase' => str_random(10),
            'ubicacion' => str_random(10),
            'tipo' => 1,
        ]);*/
    	factory(App\Classification::class, 15)->create();
    }
}
