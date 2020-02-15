<?php

use Illuminate\Database\Seeder;
use App\Book;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
		factory(Book::class, 50)->create();
    }
}
