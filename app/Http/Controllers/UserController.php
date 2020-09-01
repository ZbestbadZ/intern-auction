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

class UserController extends Controller
{
	protected $productModel;

    public function __construct(Product $model)
    {
        $this->productModel = $model;
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
        return view('user.detail_product', compact('product'));
    }

    public function postAuction(Request $request, $id){

        try {
            $data = $request->only(['bid_price']);
           
            $product = Product::find($id)
                                ->join('auctions_detail', 'products.id', '=', 'auctions_detail.product_id')
                                ->update($data);
            return redirect()->back();
        } catch(Exception $e) {
            $mess = $e->getMessage() ;
            return redirect()->back();
        }
    }
}
