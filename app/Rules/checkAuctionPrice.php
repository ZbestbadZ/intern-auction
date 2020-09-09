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
    public function __construct()
    {
        //
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
        return AuctionsDetail::where('bid_price', '>=', $value)->count() == 0;
    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The auction price must be higher than the current price';
    }
}
