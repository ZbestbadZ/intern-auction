<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            'name' => 'admin',
            'username'=> 'admin',
            'email'=> 'admin@gmail.com',
            'role'=> '1',
            'password'=> bcrypt('123'),
        ]);
        DB::table('users')->insert([

            'name' => 'user',
            'username'=> 'user',
            'email'=> 'user@gmail.com',
            'role'=> '0',
            'password'=> bcrypt('123'),
        ]);

    }
}
