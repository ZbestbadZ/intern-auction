<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
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
        try{
            $data = $request->only(['name', 'description', 'image', 'minimum_bid', 'start_price','is_bidding']);
            
            

            $product = Product::create($data);
        
            $image = request()->file(['image']);

            if(isset($image)){
            $imgPath =  $image->store('uploads/'.$product->id,'public');
        
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $imgPath, 
                'name' => $image->getClientOriginalName(),
            ]);
            }
        
        } catch(Exception $e) {
            $mess = $e->getMessage() ;
            return redirect()->route('products.index')->withErrors($mess)->withInput();
        }
        return redirect()->route('products.index');
    }

    public function edit($id){
        $product = $this->productModel->find($id);
        
        return view('product.edit',compact('product'));
    }

    public function update(ProductUpdateRequest $request, $id){
        try{
            $data = $request->only(['name', 'description', 'image', 'minimum_bid', 'start_price','is_bidding']);
            
            if(!isset($data['is_bidding']))$data['is_bidding'] = false;

            $product = Product::find($id)->update($data);
            
            $image = request()->file(['image']);
            if(isset($image)){
            $imgPath =  $image->store('uploads/'.$product->id,'public');
        
            ProductImage::create([
              'product_id' => $product->id,
              'image_url' => $imgPath, 
                'name' => $image->getClientOriginalName(),
              ]);
            }
            
        }catch(Exception $e) {
            $mess = $e->getMessage() ;
            return redirect()->route('products.index')->withErrors($mess)->withInput();

        }
        return redirect()->route('products.index');
    }

    public function destroy($id){
        $product = $this->productModel->find($id);  
        $product->delete();
        return redirect()->route('products.index');
    }

    public function index(){
        $warning = request(['warning']);
        
        $products = Product::paginate(config('const.product_paging'));
        return view('product.index', ['products'=>$products, 'warning'=>$warning]);
    
    }
     
    public function show($id){
        $product = $this->productModel->find($id);
        return view('product.show', compact('product'));
    }

   

}
