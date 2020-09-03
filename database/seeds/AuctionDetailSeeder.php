<?php

use Illuminate\Database\Seeder;

class AuctionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auctions_detail')->insert([
            'auction_id' => '1',
            'user_id' => '1',
            'bid_price' => '200',
            'bid_time' => '2020-9-5 9:15:44',
        ]);

        DB::table('auctions_detail')->insert([
            'auction_id' => '2',
            'user_id' => '2',
            'bid_price' => '300',
            'bid_time' => '2020-9-15 9:15:44',
        ]);
    }
}
