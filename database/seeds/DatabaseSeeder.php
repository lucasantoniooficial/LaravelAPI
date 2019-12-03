<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       \App\User::create([
           'nome' => 'Lucas Antonio',
           'email' => 'lucas@emlive.com.br',
           'password' => bcrypt('123')
       ]);
    }
}
