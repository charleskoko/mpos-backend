<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'addOrderLineItem.*.product_id' => 'required|uuid|exists:products,id',
            'addOrderLineItem.*.amount' => 'required|numeric',
            'addOrderLineItem.*.price' => 'required|numeric',
        ];
    }
}
