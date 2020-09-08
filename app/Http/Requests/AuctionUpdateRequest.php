<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuctionUpdateRequest extends FormRequest
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
    protected function prepareForValidation()
    {

        $start_date = str_replace('T', ' ', $this['start_date']);
        $end_date = str_replace('T', ' ', $this['end_date']);

        $this->merge([
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'end_date' => 'required|date|after:now',
        ];
    }
    public function messages()
    {
        return [
            'end_date.required' =>'Date is require',
            'end_date.date' => 'End must be date',
            'end_date.after' => 'Invalid Date',
        ];
    }
}
