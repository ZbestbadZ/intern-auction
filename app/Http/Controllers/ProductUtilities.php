<?php
namespace App\Http\Controllers;


use App\Models\Product;
use Carbon\Carbon;

class ProductUtilities {
    public static function checkProducts()
    {     
        Product::join('auctions', 'products.id', '=', 'auctions.product_id')
                ->whereDate('end_date', '<=', Carbon::now())
                ->select('*')
                ->update([
                    'is_bidding' => '0',
                    'status' => '1',
                ]);
    }
    public static function auctionIsOutDate($productId)
    {
        $product = Product::find($productId);
        $auction = $product->auction;
        $endDate = Carbon::parse($auction->end_date);
        return $endDate->lessThanOrEqualTo(Carbon::now());
    }
}