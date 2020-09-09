<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $table = "product_images";

    protected $fillable = [
        'name', 'image_url', 'product_id',
    ];

    public function delete()
    {
        parent::delete();

        $result = Storage::delete('public/' . $this->image_url);

    }

    public function product()
    {

        return $this->beLongsTo(Product::class, 'product_id', 'id');
    }

}
