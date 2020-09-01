<?php

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
        DB::table('auctions')->insert([
                    
            'product_id' => '1',
            'start_date' => '2020-9-2 9:15:44',
            'end_date'   => '2020-9-2 22:23:44'

        ]);

        DB::table('auctions')->insert([
                    
            'product_id' => '2',
            'start_date' => '2020-9-2 9:15:44',
            'end_date'   => '2020-9-2 22:23:44'

        ]);

        // DB::table('auctions')->insert([
                    
        //     'product_id' => '3',
        //     'start_date' => '2020-9-2 9:15:44',
        //     'end_date'   => '2020-9-2 22:23:44'

        // ]);

       
    }
}
