<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionDetail extends Model
{
    protected $table = "auctions_detail";

    public function AuctionDetail(){
    	return this->beLongTo('App\Auction');
    }

    public function user(){
    	return this->beLongTo('App\User');
    }
}
