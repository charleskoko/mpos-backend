<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPostRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Traits\ApiResponse;
use Domain\Orders\Actions\CreateOrderAction;
use Domain\Orders\DataTransferObjects\MakeOrderLineItemsData;
use Domain\Orders\Events\NewOrderCreatedEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use ApiResponse;
    private CreateOrderAction $createOrderAction;

    public function __construct(CreateOrderAction $createOrderAction)
    {
        $this->createOrderAction = $createOrderAction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        $authUser = Auth::user();

        $authUserOrders = $authUser->orders()->where('created_at', '=',now())->get();

        return $this->success([OrderResource::collection($authUserOrders)],);
    }

    /**
     * Display the specified resource.
     *
     * @param OrderPostRequest $request
     * @return JsonResponse
     */

    public function store(OrderPostRequest $request): JsonResponse
    {
        $orderLineItemsValidated = $request->validated();
        $orderLineItemsData = MakeOrderLineItemsData::fromRequest($orderLineItemsValidated['addOrderLineItem']);
        $order = ($this->createOrderAction)($orderLineItemsData);
        NewOrderCreatedEvent::dispatch($order);

        return $this->success([OrderResource::make($order)],201);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function show(Order $order): JsonResponse
    {
        return $this->success([OrderResource::make($order)]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return $this->success([], 204);
    }
}
