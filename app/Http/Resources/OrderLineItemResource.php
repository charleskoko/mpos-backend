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
            'id' => $orderLineItem->id,
            'product' => ProductResource::make($orderLineItem->product),
            'product_label' => $orderLineItem->product_label,
            'price' => $orderLineItem->price,
            'amount' => $orderLineItem->amount,
        ];
    }
}
