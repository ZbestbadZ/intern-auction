<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "products";

    protected $fillable = [
        'name','status','is_bidding','description','start_price', 'minimum_bid',
    ];

    public function auction()
    {
        return $this->hasOne(Auction::class, 'product_id', 'id');
    }

    public function product_image(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
