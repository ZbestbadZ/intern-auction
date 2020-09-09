<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\AuctionsDetail;
use App\Models\Product;
use DB;

class checkAuctionPrice implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $auctionDetailModel;
    protected $productModel;
    public function __construct($productId)
    {
        $this->productModel = Product::find($productId);
        $this->auctionDetailModel = $this->productModel->auction->auctionDetail;
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->productModel->minimum_bid==0)return true;
        $oldPrice = $this->auctionDetailModel->bid_price?$this->auctionDetailModel->bid_price:$this->productModel->start_price;
        
        $result = is_int((int)($value -  $oldPrice)/ $this->productModel->minimum_bid)  ;
        return $result;
    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    { 
        $oldPrice = $this->auctionDetailModel->bid_price?$this->auctionDetailModel->bid_price:$this->productModel->start_price;
        
        return 'invalid price ( nearest acceptable price: '.number_format($this->productModel->minimum_bid + $oldPrice).')';
    }
}
