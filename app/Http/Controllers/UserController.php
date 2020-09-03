<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\AuctionDetail;
use App\Models\Auction;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
	protected $productModel;

    public function __construct(Product $model)
    {
        $this->productModel = $model->select('*');
    }

    public function getList_product()
    {
        $warning = request(['warning']);
        $products = Product::paginate(config('const.product_paging'))
                            ->where('status', 1)
                            ->join('auctions', 'products.id', '=', 'auctions.product_id')
                            ->get();
        return view('user.list_product', ['products'=>$products, 'warning'=>$warning]);
    }

    public function getShow($id){
        $product = $this->productModel->find($id);
        $auctions = DB::table('auctions')
                        ->join('auctions_detail', 'auctions.id', '=', 'auctions_detail.auction_id')
                        ->join('products', 'products.id', '=', 'auctions.product_id')
                        ->select('auctions.start_date', 'auctions.end_date', 'auctions_detail.bid_price')
                        ->where('auctions.product_id', $id)
                        ->get();

        return view('user.detail_product', compact('product', 'auctions'));
    }

    public function postAuction(Request $request, $id){

        try {
            $data = array();
            $auction = AuctionDetail::find($id);
            $data['auction'] = $auction;
            if ($request->isMethod ('patch')){
                $bid_price = $request->input('bid_price');
                $auction->bid_price = $bid_price;
                $auction->save();
            }
                return redirect()->back();
            
        } catch(Exception $e) {
            $mess = $e->getMessage() ;
            return redirect()->route('user.list_product',['warning' => '1']);
        }
    }
}
