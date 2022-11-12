<?php

namespace Domain\Orders\DataTransferObjects;

class OrderLineItemData
{

    public ?string $productId;
    public string $productLabel;
   //public ?string $orderLineItemNote;
    public float $price;
    public float $amount;

    public static function fromRequest(array $validatedOrderLineData): OrderLineItemData
    {
        $dto = new self();
        $dto->productId = $validatedOrderLineData['product_id'];
        $dto->productLabel = $validatedOrderLineData['product_label'];
        //$dto->orderLineItemNote = $validatedOrderLineData['order_line_item_note'];
        $dto->price = $validatedOrderLineData['price'];
        $dto->amount = $validatedOrderLineData['amount'];

        return $dto;

    }

}
