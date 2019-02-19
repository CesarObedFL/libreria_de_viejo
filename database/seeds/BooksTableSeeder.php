<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
		factory(App\Book::class, 50)->create();
    }
}
