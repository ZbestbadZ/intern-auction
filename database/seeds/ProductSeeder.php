<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
