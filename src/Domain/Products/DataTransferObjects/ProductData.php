<?php

namespace Domain\Products\DataTransferObjects;


use Illuminate\Support\Facades\Auth;

class ProductData
{
    public ?string $label;
    public ?string $salePrice;
    public ?string $purchasePrice;
    public ?string $stock;
    public string $userId;

    public static function fromRequest(array $validatedProductData): ProductData
    {
        $dto = new self();
        $dto->label = $validatedProductData['label'];
        $dto->salePrice = $validatedProductData['sale_price'];
        $dto->purchasePrice = $validatedProductData['purchase_price'];
        //$dto->stock = $validatedProductData['stock'];
        $dto->userId = Auth::id();

        return $dto;
    }
}
