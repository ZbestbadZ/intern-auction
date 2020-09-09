<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;

class ProductImageController extends Controller
{
    public function destroy($id)
    {
        try {
            $productImage = ProductImage::find($id);
            $productImage->delete();

        } catch (Exception $e) {
            return redirect()->route('products.index')->withErrors($e->getMessage());
        }

        return redirect()->back();
    }
}
