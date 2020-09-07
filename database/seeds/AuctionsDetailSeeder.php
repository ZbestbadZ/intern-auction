<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuctionsDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auctions_detail') -> insert([
            'auction_id' => '1',


        ]);
        DB::table('auctions_detail') -> insert([
            'auction_id' => '3',

            
        ]);
        DB::table('auctions_detail') -> insert([
            'auction_id' => '2',

            
        ]);

        
    }
}
