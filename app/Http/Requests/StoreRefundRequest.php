<?php

namespace App\Http\Requests;

use App\Models\Refund;
use Illuminate\Foundation\Http\FormRequest;

class StoreRefundRequest extends FormRequest
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
            'order_id' => 'required|exists:orders,id',
            'amount_refunded' => 'required|numeric',
            'reason' => 'required|in:'.implode(',',Refund::REASONS),
        ];
    }
}


