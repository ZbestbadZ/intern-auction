<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table ="auctions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','start_date','end_date',
    ];

    public function product(){
        return $this->beLongTo('App\Product', 'product_id');
    }

    public function auction_detail()
    {
        return $this->hasOne('App\AuctionDetail', 'auction_id');
    }
}
