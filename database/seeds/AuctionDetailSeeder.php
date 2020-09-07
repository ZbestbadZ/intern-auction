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
        $faker = Faker\Factory::create();
        
        for ($x = 1; $x <= 6; $x+=1) {
        DB::table('auctions_detail')
        ->where(['id' => $x])
        ->update([
            'auction_id' => $x,
            'user_id' => $x ,
            'bid_price'=> $faker->randomFloat(2,1100,2000),
            'bid_time'=> Carbon::now(),
        ]);
        }
    }
}
