<?php

use App\Models\Product;
use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        //product
        for ($x = 0; $x <= 8; $x+=1) {
            $product = Product::create([
                'name' => $faker->name(),
                'status' => '0',
                'is_bidding' => '1',
                'description' => $faker->text(),
                'start_price' => $faker->randomFloat(2,500,1000),
                'minimum_bid' => $faker->randomFloat(2,40,100),
            ]);
            $product->auction->update(['end_date'=>Carbon::now()->addDay()]);
        }
        for ($x = 0; $x <= 5; $x+=1) {
            
           
            Product::create([

                'name' => $faker->name(),
                'status' => '1',
                'is_bidding' => '0',
                'description' => $faker->text(),
                'start_price' => $faker->randomFloat(2,500,1000),
                'minimum_bid' => $faker->randomFloat(2,40,100),
    
            ]);
            Product::create([

                'name' => $faker->name(),
                'status' => '0',
                'is_bidding' => '0',
                'description' => $faker->text(),
                'start_price' => $faker->randomFloat(2,500,1000),
                'minimum_bid' => $faker->randomFloat(2,40,100),
    
            ]);
          }
       
        
        
        

        //
    }
}
