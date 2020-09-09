<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productModel;

    public function __construct(Product $model)
    {
        ProductUtilities::checkProducts();
        $this->productModel = $model;
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            $data = $request->only(['name', 'description', 'image', 'minimum_bid', 'start_price', 'is_bidding']);

            $data['is_bidding'] = isset($request->is_bidding);

            $product = Product::create($data);
            $files = $request->file('image');

            if ($request->hasFile('image')) {

                foreach ($files as $file) {
                    $imgPath = $file->store('uploads/' . $product->id, 'public');

                    $image = ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $imgPath,
                        'name' => $file->getClientOriginalName(),
                    ]);

                }
            }

        } catch (Exception $e) {
            $mess = $e->getMessage();
            return redirect()->route('products.index')->withErrors($mess)->withInput();
        }
        return redirect()->route('products.index');
    }

    public function edit(Request $request,$id)
    {
        try {
            

            $product = $this->productModel->find($id);
            
            if($request->has('restart')) {
                $data = $product->attributesToArray();
                $data['status'] = false;
                $product->update($data);
            }
            
            $hasBidder = $product->hasBidder();
            $images = $product->images;
            $endDate = Carbon::parse($product->auction->end_date);
            $startDate = Carbon::parse($product->auction->start_date);

        } catch (Exception $e) {
            $mess = $e->getMessage();
            return redirect()->route('products.index')->withErrors($mess)->withInput();
        }

        return view('product.edit', compact('product', 'images', 'hasBidder', 'endDate', 'startDate',));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $product = Product::find($id);
            $data = $request->only(['name', 'description', 'image', 'minimum_bid', 'start_price', 'is_bidding']);

            $endDate = $request->end_date;

            $files = $request->file('image');

            if ($data['is_bidding'] && $product->status) {
                $data['status'] = false;
            }

            $product->auction->update(['end_date' => $endDate]);

            $product->update($data);

            if ($request->hasFile('image')) {

                foreach ($files as $file) {
                    $imgPath = $file->store('uploads/' . $product->id, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $imgPath,
                        'name' => $file->getClientOriginalName(),
                    ]);

                }
            }

        } catch (Exception $e) {
            $mess = $e->getMessage();
            return redirect()->route('products.index')->withErrors($mess)->withInput();

        }
        return redirect()->back()->withInput();
    }

    public function destroy($id)
    {

        $product = $this->productModel->find($id);

        $product->delete();
        return redirect()->route('products.index');
    }

    public function index(Request $request)
    {
        $warning = request(['warning']);
        $products = null;
        if (request(['search'])) {
            try {
                $search = request('search');
                $products = Product::where('name', 'like', '%' . $search . '%')
                    ->paginate(config('const.product_paging'));

            } catch (Exception $e) {
                $mess = $e->getMessage();
                return redirect()->route('products.index')->withErrors($mess);

            }
        } else if (request('sortBy')) {
            try {
                switch (request('sortBy')) {
                    case 'name':{
                            $products = Product::orderBy('name')
                                ->paginate(config('const.product_paging'));
                            $products->withPath('products?sortBy=name');
                            break;
                        }
                    case 'endDate':{
                            $products = Product::orderBy('end_Date')
                                ->join('auctions', 'products.id', '=', 'auctions.id')
                                ->paginate(config('const.product_paging'));
                            $products->withPath('products?sortBy=endDate');
                            break;
                        }
                    case 'startDate':{
                            $products = Product::orderBy('start_Date')
                                ->join('auctions', 'products.id', '=', 'auctions.id')
                                ->paginate(config('const.product_paging'));
                            $products->withPath('products?sortBy=startDate');

                            break;
                        }

                    default:{
                            
                            $products = Product::paginate(config('const.product_paging'));
                        }
                }
            } catch (Exception $e) {
                $mess = $e->getMessage();
                return redirect()->route('products.index')->withErrors($mess);

            }
        } else {
            $products = Product::paginate(config('const.product_paging'));
        }

        return view('product.index', ['products' => $products, 'warning' => $warning]);

    }

    public function show($id)
    {
        $product = $this->productModel->find($id);

        $auction = $product->auction;
        
        $bidder = Product::find($id)->hasBidder();
        $highestBid = $auction->auctionDetail->bid_price;
        
        $startDate = Carbon::parse($auction->start_date);

        $endDate = $auction->end_date ? Carbon::parse($auction->end_date) : '';

        $status = $product->status;
        $isBidding = $product->is_bidding;
        

        return view('product.show', [
            'product' => $product,
            'status' => $status,
            'bidder' => $bidder,
            'isBidding' => $isBidding,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'highestBid' => $highestBid,
        ]);
    }

}
