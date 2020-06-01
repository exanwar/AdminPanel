<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'username'=> 'exanwar',
            'name' => 'Anowarul Islam',
            'email' => 'exanwar@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('Anowar_09199'),
        ]);
    }
}
