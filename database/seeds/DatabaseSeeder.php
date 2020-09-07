<?php

use App\Models\AuctionDetail;
use App\Models\AuctionsDetail;
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
        
        $classes =[
        UserSeeder::class,
        ProductSeeder::class,
        AuctionSeeder::class,
        AuctionsDetailSeeder::class,
        ];

        $this->call($classes);               
    }
}
