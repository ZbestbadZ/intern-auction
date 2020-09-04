<?php

namespace App\Models;

use App\Models\AuctionDetail;
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

    public static  function boot() {
        parent::boot();
        static::created(function (Auction $item) {
            AuctionsDetail::create(['auction_id'=>$item->id,]);
        });
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id' , 'id');
    }

    public function auctionDetail()
    {
        return $this->hasOne(AuctionsDetail::class, 'auction_id', 'id');
    }
}
