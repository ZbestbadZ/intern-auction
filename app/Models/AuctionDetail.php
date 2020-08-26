<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class AuctionDetail extends Model
{
    protected $table = "auctions_detail";

    public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function auction(){
    	return $this->beLongsTo(Auction::class, 'auction_id', 'id');
    }
}
