<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = "product_images";

    protected $fillable = [
        'name','image_url','product_id'
    ];

    public function product(){
        
    	return $this->beLongsTo(Product::class, 'product_id', 'id');
    }

    

}
