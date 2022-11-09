<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPostRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Domain\Invoices\Actions\CreateInvoiceAction;
use Domain\Orders\Actions\CreateOrderAction;
use Domain\Orders\DataTransferObjects\MakeOrderLineItemsData;
use Domain\Products\Actions\UpdateProductStockAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use ApiResponse;
    private CreateOrderAction $createOrderAction;
    private UpdateProductStockAction $updateProductStockAction;
    private CreateInvoiceAction  $createInvoiceAction;

    public function __construct(CreateOrderAction $createOrderAction, UpdateProductStockAction $updateProductStockAction, CreateInvoiceAction $createInvoiceAction)
    {
        $this->createOrderAction = $createOrderAction;
        $this->updateProductStockAction = $updateProductStockAction;
        $this->createInvoiceAction = $createInvoiceAction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function dashboardInfo(Request $request): JsonResponse
    {
        $date = $request->input('date');
        $period = $request->input('period');
        $authUserOrders = $this->getOrderDependingOfDateAndPeriod($date, $period);
        return $this->success([OrderResource::collection($authUserOrders)],);

    }

    public function index()
    {
        $authUser = Auth::user();
        $authUserOrders = $authUser->orders;
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
        $invoice = ($this->createInvoiceAction)($order->id);

        $order->update(['invoice_id' => $invoice->id]);
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

    private function getOrderDependingOfDateAndPeriod($date, $period)
    {
        $authUser = Auth::user();

        switch ($period) {
            case '1j':
                $dateToCarbonFormat = Carbon::create($date);
                return $authUser->orders()->whereDay('created_at', '=', $dateToCarbonFormat)->get();
            case '1s':
                $endDateToCarbonFormat = Carbon::create($date);
                $startDateToCarbonFormat = CarbonImmutable::create($date)->subWeek();
                return $authUser->orders()->whereBetween('created_at', [$startDateToCarbonFormat, $endDateToCarbonFormat])->get();
            case '1m':
                $endDateToCarbonFormat = Carbon::create($date);
                $startDateToCarbonFormat = CarbonImmutable::create($date)->subMonth();
                return $authUser->orders()->whereBetween('created_at', [$startDateToCarbonFormat, $endDateToCarbonFormat])->get();
            case '3m':
                $endDateToCarbonFormat = Carbon::create($date);
                $startDateToCarbonFormat = CarbonImmutable::create($date)->subMonths(3);
                return $authUser->orders()->whereBetween('created_at', [$startDateToCarbonFormat, $endDateToCarbonFormat])->get();
            case'1a':
                $endDateToCarbonFormat = Carbon::create($date);
                $startDateToCarbonFormat = CarbonImmutable::create($date)->subYear();
                return $authUser->orders()->whereBetween('created_at', [$startDateToCarbonFormat, $endDateToCarbonFormat])->get();
        }


    }
}
