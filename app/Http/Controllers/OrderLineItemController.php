<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderLineItemPostRequest;
use App\Http\Resources\OrderLineItemResource;
use App\Models\OrderLineItem;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class OrderLineItemController extends Controller
{
    use ApiResponse;

    /**
     * Display the specified resource.
     *
     * @param OrderLineItem $orderLineItem
     * @return JsonResponse
     */
    public function show(OrderLineItem $orderLineItem): JsonResponse
    {
        return $this->success([OrderLineItemResource::make($orderLineItem)]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param OrderLineItem $orderLineItem
     * @return JsonResponse
     */
    public function update(OrderLineItemPostRequest $request, OrderLineItem $orderLineItem)
    {
        $newOrderLineItemDataValidated = $request->validated();
        $orderLineItem->update($newOrderLineItemDataValidated);

        return $this->success([OrderLineItemResource::make($orderLineItem->refresh())]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OrderLineItem $orderLineItem
     * @return JsonResponse
     */
    public function destroy(OrderLineItem $orderLineItem): JsonResponse
    {
        $orderLineItem->delete();

        return $this->success([], 204);
    }
}
