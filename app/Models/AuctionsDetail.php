<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionsDetail extends Model
{
    
    protected $table = "auctions_detail";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'auction_id',
        'user_id',
        'bid_price',
        'bid_time',
    ];

    public $timestamps = false;
    
    public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function auction(){
    	return $this->beLongsTo(Auction::class, 'auction_id', 'id');
    }
}