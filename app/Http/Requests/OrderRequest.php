<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'address' => 'required|string|min:5|max:255',
            'phone_number' => 'required|string|min:11|max:11',
            'delivery_time' => 'required|date_format:Y-m-d H:i:s|after:3 hours|before:9 days',
            'cut' => 'required|boolean',
            'purchase.*.row' => 'required|integer|min:1',
            'purchase.*.place' => 'required|integer|min:1'
        ];
    }
}
