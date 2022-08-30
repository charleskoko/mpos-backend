<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this->resource;
        return [
            'id' => $user->id,
            'name' => $user->name,
            'mobile' => $user->mobile,
            'unique_number' => $user->unique_number,
            'email' => $user->email,
            'created_at' => $user->created_at,
        ];
    }
}
