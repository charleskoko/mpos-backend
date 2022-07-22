<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $order = $this->resource;
        return [
            'id' => $order->id,
            'number' => $order->number,
            'OrderLineItems' => OrderLineItemResource::collection($order->orderLineItems)
        ];
    }
}
