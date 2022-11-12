<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $order = $this->resource;
        return [
            'id' => $order->id,
            'number' => $order->number,
            'order_line_items' => OrderLineItemResource::collection($order->orderLineItems),
            'refunds' => RefundResource::collection($order->refunds),
            'created_at'=> $order->created_at,
            'invoice' => $order->invoice
        ];
    }
}
