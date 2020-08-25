<?php

namespace App;

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
        return $this->hasOne(Auction::class);
    }
}
