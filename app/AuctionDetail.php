<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionDetail extends Model
{
    protected $table = "auctions_detail";

    public function user(){
    	return $this->beLongTo('App\User');
    }

    public function auction(){
    	return $this->beLongTo('App\Auction');
    }
}
