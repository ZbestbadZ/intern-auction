<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;

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

            $product = Product::create($data);
            $files = $request->file('image');

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
        return redirect()->route('products.index');
    }

    public function edit($id)
    {

        $product = $this->productModel->find($id);

        $hasBidder = $product->auction->auctionDetail->user_id;
        if ($hasBidder) {
            $mess = "This Item has bidders in process can't be alter";
            return redirect()->route('products.index')->withErrors($mess);
        }

        return view('product.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $data = $request->only(['name', 'description', 'image', 'minimum_bid', 'start_price', 'is_bidding']);

            if (!isset($data['is_bidding'])) {
                $data['is_bidding'] = false;
            }

            $product = Product::find($id);
            $product->update($data);
            
            $files = $request->file('image');

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
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {

        $product = $this->productModel->find($id);

        $hasBidder = $product->auction->auctionDetail->user_id;
        if ($hasBidder) {
            $mess = "This Item has bidders in process can't be alter";
            return redirect()->route('products.index')->withErrors($mess);
        }

        $product->delete();
        return redirect()->route('products.index');
    }

    public function index()
    {
        $warning = request(['warning']);

        $products = Product::paginate(config('const.product_paging'));
        
        return view('product.index', ['products' => $products, 'warning' => $warning]);

    }

    public function show($id)
    {
        $product = $this->productModel->find($id);

        $auction = $product->auction;

        $startDate = Carbon::parse($auction->start_date);

        $endDate = $auction->end_date?Carbon::parse($auction->end_date):'';
        
        $status = $product->status;
        $isBidding = $product->is_bidding;
        $hasBidder = $auction->auctionDetail->user_id;

        return view('product.show', [
            'product' => $product,
            'status' => $status,
            'hasBidder' => $hasBidder,
            'isBidding' => $isBidding,
            'startDate' => $startDate,
            'endDate' => $endDate,

        ]);
    }

}
