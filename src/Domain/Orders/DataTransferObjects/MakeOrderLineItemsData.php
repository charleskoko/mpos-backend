<?php

namespace Domain\Orders\DataTransferObjects;

use App\Models\OrderLineItem;

class MakeOrderLineItemsData
{
    /**
     * @var OrderLineItem[]
     */
    public ?array $orderLineItemsData;

    public static function fromRequest(?array $validatedOrderPostRequest): MakeOrderLineItemsData
    {
        $dto = new self();
        $dto->orderLineItemsData = [];
        foreach ($validatedOrderPostRequest as $data) {
            array_push($dto->orderLineItemsData, OrderLineItemData::fromRequest($data));
        }
        return $dto;
    }

}
