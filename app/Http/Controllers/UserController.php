<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
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
        $products = Product::paginate(config('const.product_paging'));
        return view('user.list_product', ['products'=>$products, 'warning'=>$warning]);
    }

    public function getShow($id){
        $product = $this->productModel->find($id);
        return view('product.show', compact('product'));
    }

}
