<?php

namespace Domain\Products\DataTransferObjects;


use Illuminate\Support\Facades\Auth;

class ProductData
{
    public ?string $label;
    public ?string $price;
    public string $userId;

    public static function fromRequest(array $validatedProductData): ProductData
    {
        $dto = new self();
        $dto->label = $validatedProductData['label'];
        $dto->price = $validatedProductData['price'];
        $dto->userId = Auth::id();

        return $dto;
    }
}
