<?php

use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auctions')->insert([
            'product_id' => '1',
            'start_date' => '2020-9-2 9:15:44',
            'end_date' => '2020-10-2 9:15:44',    
        ]);

        DB::table('auctions')->insert([
            'product_id' => '2',
            'start_date' => '2020-9-1 9:15:44',
            'end_date' => '2020-10-1 9:15:44',    
        ]);
    }
}
