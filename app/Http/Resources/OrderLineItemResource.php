<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderLineItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $orderLineItem = $this->resource;
        return [
            'product' => ProductResource::make($orderLineItem->product),
            'price' => $orderLineItem->price,
            'amount' => $orderLineItem->amount,
        ];
    }
}
