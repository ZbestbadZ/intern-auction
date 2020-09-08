<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
class ProductImageController extends Controller
{
    public function destroy($id)
    {
        try {
            $productImage = ProductImage::find($id);
            $productImage->delete();
            $r = Storage::delete('public/'.$productImage->image_url);
            dd($r);
        } catch (Exception $e) {
            return redirect()->route('products.index')->withErrors($e->getMessage());
        }

        return redirect()->back();
    }
}
