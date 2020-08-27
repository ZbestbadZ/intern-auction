<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{

    public function create(){
        return view('product.create');
    }

    public function store() {
        $data = request()->validate([
            'name' => 'required',
            'description'=>'required',
            'ispublic' =>'',
            'status'=>'',
            'image'=> 'image',
            'minimumbid' =>'numeric',
            'startprice' => 'numeric',
        ]);

        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'is_bidding' => isset($data['ispublic']),
            'minimum_bid' => $data['minimumbid'],
            'start_price' => $data['startprice'],  
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
        return redirect()->route('product.index');
    }

    public function edit(Product $product){
        
        return view('product.edit',compact('product'));
    }

    public function update(Product $product){
        $data = request()->validate([
            'name' => 'required',
            'description'=>'required',
            'ispublic' =>'',
            'status'=>'',
            'image'=> 'image',
            'minimumbid' =>'numeric',
            'startprice' => 'numeric',
        ]);


            
        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'is_bidding' => isset($data['ispublic']),
            'minimum_bid' => $data['minimumbid'],
            'start_price' => $data['startprice'],
        ]);

        return redirect()->route('product.index');
    }

    public function destroy(Product $product){
       
        $product->delete();
        return back();
    }

    public function index(){
     
        $products = Product::paginate(2);
        return view('product.index', ['products'=>$products]);
    
    }
     
    public function show(){

    }



}
