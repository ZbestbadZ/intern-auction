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
        // $this->call(UsersTableSeeder::class);
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

        //product
        DB::table('products')->insert([
            
            'name' => 'banana',
            'status' => '1',
            'is_bidding' => '1',
            'description' => 'hihi',
            'start_price' => '123.1',
            'minimum_bid' => '20.5',

        ]);
        DB::table('products')->insert([
            
            'name' => 'banana2',
            'status' => '0',
            'is_bidding' => '1',
            'description' => 'hihi',
            'start_price' => '123.1',
            'minimum_bid' => '20.5',

        ]);
        DB::table('products')->insert([
            
            'name' => 'banana3',
            'status' => '0',
            'is_bidding' => '0',
            'description' => 'hihi',
            'start_price' => '123.1',
            'minimum_bid' => '20.5',

        ]);

        //
            
    }
}
