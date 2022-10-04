<?php

namespace Domain\Products\Actions;

use App\Models\Product;
use Domain\Products\DataTransferObjects\ProductData;

class CreateProductAction
{
    public function __invoke(ProductData $productData): Product
    {
        return Product::create(
            [

                'label' => $productData->label,
                'sale_price' => $productData->salePrice,
                'user_id' => $productData->userId,
                'purchase_price' => $productData->purchasePrice,
            ]
        );

    }

}
