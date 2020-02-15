<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("users")->insert([
            'name' => 'María Fernanda Sánchez',
            'email' => 'cultura@casacem.org',
            'password' => bcrypt('PR03C0V1A'),
            'phone' => '0',
            'role' => 'Administrador',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Cynthia Mercado',
            'email' => 'cmercado@casacem.org',
            'password' => bcrypt('12345'),
            'phone' => '0',
            'role' => 'Administrador',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Saory',
            'email' => 'saorygarcia1@gmail.com',
            'password' => bcrypt('saory5'),
            'phone' => '3315180490',
            'role' => 'Vendedor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Adriana',
            'email' => 'adriguipe@gmail.com',
            'password' => bcrypt('pelusa2'),
            'phone' => '3335596555',
            'role' => 'Administrador',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Caín',
            'email' => 'copiti3@gmail.com',
            'password' => bcrypt('Libr0symusica'),
            'phone' => '3313989612',
            'role' => 'Vendedor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Lilian',
            'email' => 'salazar.lilian@javeriana.edu',
            'password' => bcrypt('elianjO43'),
            'phone' => '4294967295',
            'role' => 'Vendedor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Yunuen Feregrino',
            'email' => 'c.verdeazulado@gmail.com',
            'password' => bcrypt('yunuen1997'),
            'phone' => '3123024664',
            'role' => 'Vendedor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Andrea Valencia',
            'email' => 'andrea.valencia@outlook.com',
            'password' => bcrypt('Adam2010'),
            'phone' => '3863092380',
            'role' => 'Vendedor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Iván Eduardo Hernandez Gómez',
            'email' => 'hernandezgomivan@gmail.com',
            'password' => bcrypt('always1234567'),
            'phone' => '3311024989',
            'role' => 'Vendedor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Luis Téllez',
            'email' => 'luistellezgarza@gmail.com',
            'password' => bcrypt('mutuaxshe'),
            'phone' => '3312447632',
            'role' => 'Vendedor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table("users")->insert([
            'name' => 'Montse Esquivel',
            'email' => 'itrinidadesquivel@gmail.com',
            'password' => bcrypt('sueñosdeazul'),
            'phone' => '4294967295',
            'role' => 'Vendedor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /*
        DB::table("users")->insert([
            'name' => '',
            'email' => '',
            'password' => bcrypt(''),
            'phone' => '',
            'role' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        */
    }
}
