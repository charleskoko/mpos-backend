<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = $this->resource;

        return [
            'id' => $product->id,
            'label' => $product->label,
            'purchase_price' => $product->purchase_price,
            'sale_price' => $product->sale_price,
            'is_deleted' => $product->is_deleted,
            'stock' => $product->stock,
            'owner' => UserResource::make($product->owner),
            'created_at' => $product->creted_at,
            'updated_at' => $product->updated_at
        ];
    }
}
