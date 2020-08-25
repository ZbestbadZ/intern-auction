<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = "product_images";

    protected $fillable = [
        'name','image_url',
    ];

    public function product(){
    	return this->beLongTo('App\Product');
    }
}
