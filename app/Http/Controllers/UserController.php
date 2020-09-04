<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionsDetail;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $productModel;

    public function __construct(Product $model)
    {
        $this->productModel = $model;
    }

    public function getList_product()
    {
        ProductUtilities::checkProducts();
        $products = Product::where([['status', 0], ['is_bidding', 1]])
            ->paginate(config('const.product_paging'));
        
        return view('user.list_product', [
            'products' => $products,   
        ]);
    }

    public function getShow($id)
    {
        $product = $this->productModel->find($id);
        $auctionDetail = $product->auction->auctionDetail;

        $auction = $product->auction;
        return view('user.detail_product', compact('product', 'auction', 'auctionDetail'));
    }

    public function postAuction(Request $request, $id)
    {
        try {

            $auctionDetail = AuctionsDetail::find($id);

            if (ProductUtilities::auctionIsOutDate($id)) {
                return redirect()->route('user.list_product', ['warning' => 'Auction is outdated']);
            }

            $bid_price = $request->input('bid_price');
            $auctionDetail->bid_price = $bid_price;
            $auctionDetail->bid_time = Carbon::now();
            $auctionDetail->save();

            return redirect()->back();

        } catch (Exception $e) {
            $mess = $e->getMessage();
            return redirect()->route('user.list_product', ['warning' => $mess]);
        }
    }

}
