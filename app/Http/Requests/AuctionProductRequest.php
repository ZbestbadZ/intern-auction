<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\checkAuctionPrice;

class AuctionProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $oldBidPice = Product::find($this->id)->auction->auctionDetail->bid_price?Product::find($this->id)->auction->auctionDetail->bid_price:Product::find($this->id)->start_price;
        
        return [
            'bid_price' => ['gt:'.$oldBidPice,'required','integer', new checkAuctionPrice($this->id)],
        ];
    }
    public function messages()
    {
        return [
            'bid_price.gt' =>'Giá tiền phai cao hơn',            
        ];
    }
    
}
