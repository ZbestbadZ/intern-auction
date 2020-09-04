<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
        return [
            'name' => 'required|max:40',
            'description'=>'required|max:255',
            'image.*'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'minimum_bid' =>'numeric',
            'start_price' => 'numeric',
        ];
    }
}
