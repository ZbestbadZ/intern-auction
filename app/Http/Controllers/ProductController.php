<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    protected $productModel;

    public function __construct(Product $model)
    {
        $this->productModel = $model;
    }

    public function create(){
        return view('product.create');
    }

    public function store(ProductStoreRequest $request) {
        
        $validated = $request->validated();
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $request['description'],
            'minimum_bid' => $request['minimum_bid'],
            'is_bidding' => $request['is_bidding'],
            'start_price' => $request['start_price'],  
        ]);
        
        $image = request()->file(['image']);
        if(isset($image)){
        $imgPath =  $image->store('uploads/'.$product->id,'public');
        
        ProductImage::create([
            'product_id' => $product->id,
            'image_url' => $imgPath, 
            'name' => $image->getClientOriginalName(),
        ]);
        }
        return redirect()->route('products.index');
    }

    public function edit($id){
        $product = $this->productModel->find($id);
        
        return view('product.edit',compact('product'));
    }

    public function update(ProductUpdateRequest $request, $id){
       // dd($id);
        $validated = $request->validated();
        $product = Product::find($id)->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'minimum_bid' => $validated['minimum_bid'],
            'start_price' => $validated['start_price'],  
        ]);

        $image = request()->file(['image']);
        if(isset($image)){
        $imgPath =  $image->store('uploads/'.$product->id,'public');
        
        ProductImage::create([
            'product_id' => $product->id,
            'image_url' => $imgPath, 
            'name' => $image->getClientOriginalName(),
        ]);
        }

        return redirect()->route('products.index');
    }

    public function destroy($id){
       
        $product = Product::find($id)->delete();
        return redirect()->route('products.index');
    }

    public function index(){
     
        $products = Product::paginate(config('app.product_paging'));
        return view('product.index', ['products'=>$products]);
    
    }
     
    public function show(Product $product){
        
        return view('product.show', compact('product'));
    }



}
