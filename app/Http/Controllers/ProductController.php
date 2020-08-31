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
        $request->validated();
        $validated = $request->only(['name', 'description', 'image', 'minimum_bid', 'start_price']);
        $product = Product::create($validated);
        
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
        $request->validated();
        $validated = $request->only(['name', 'description', 'image', 'minimum_bid', 'start_price']);
        $product = Product::find($id)->update($validated);

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
        $product = $this->productModel->find($id);  
        $product->delete();
        return redirect()->route('products.index');
    }

    public function index(){
     
        $products = Product::paginate(config('const.product_paging'));
        return view('product.index', ['products'=>$products]);
    
    }
     
    public function show($id){
        $product = $this->productModel->find($id);
        return view('product.show', compact('product'));
    }



}
