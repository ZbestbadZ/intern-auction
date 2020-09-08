<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 6; $x+=1) {
            DB::table('auctions')->insert([
                    
                'product_id' => $x,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::tomorrow(),    
            ]);
            }
    }
}
