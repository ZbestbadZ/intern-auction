<?php

use Illuminate\Database\Seeder;

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
            'password'=> 'admin',
            'role'=> '1',
            'email'=> 'admin@gmail.com',
            'phone'=> '0987654321',
        ]);
        DB::table('users')->insert([

            'name' => 'user',
            'username'=> 'user',
            'password'=> 'user',
            'role'=> '0',
            'email'=> 'user@gmail.com',
            'phone'=> '0987654321',
        ]);

    }
}
