<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RefundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $refund = $this->resource;
        return [
            'reason' => $refund->reason,
            'amount_refunded' => $refund->amount_refunded,
            'order_id' => $refund->order_id,
            'created_at' => $refund->created_at,
            'updated_at' => $refund->updated_at
        ];
    }
}
