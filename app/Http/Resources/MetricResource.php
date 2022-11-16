<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MetricResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this->resource;
        return [
            'email' => $user->email,
            'name' => $user->name,
            'number_of_product' => count($user->products),
            'created_at' => $user->created_at,
            'orders' => count($user->orders),
        ];
    }
}
