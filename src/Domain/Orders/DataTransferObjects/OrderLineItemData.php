<?php

namespace Domain\Orders\DataTransferObjects;

class OrderLineItemData
{

    public ?string $productId;
    public float $price;
    public float $amount;

    public static function fromRequest(array $validatedOrderLineData): OrderLineItemData
    {
        $dto = new self();
        $dto->productId = $validatedOrderLineData['product_id'];
        $dto->price = $validatedOrderLineData['price'];
        $dto->amount = $validatedOrderLineData['amount'];

        return $dto;

    }

}
