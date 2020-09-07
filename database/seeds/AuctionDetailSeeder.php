<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuctionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 6; $x+=1) {
        DB::table('auctions_detail')->insert([
            'auction_id' => $x,
            'user_id' => $x ,
            'bid_price'=> '1000',
            'bid_time'=> Carbon::now(),
        ]);
        }
    }
}
