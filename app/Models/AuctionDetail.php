<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class AuctionDetail extends Model
{
    protected $table = "auctions_detail";

    public function user(){
    	return $this->beLongToMany(User::class, 'user_auction_detail' , 'user_id', 'auction_detail_id');
    }

    public function auction(){
    	return $this->beLongTo(Auction::class, 'auction_id', 'id');
    }
}
