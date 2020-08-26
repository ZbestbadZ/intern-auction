<?php

namespace App\Models;

use App\AuctionDetail;
use Illuminate\Database\Eloquent\Model;
;

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
        return $this->beLongTo(Product::class, 'product_id' , 'id');
    }

    public function auction_detail()
    {
        return $this->hasOne(AuctionDetail::class, 'auction_id', 'id');
    }
}
