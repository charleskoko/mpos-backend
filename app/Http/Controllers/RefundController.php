<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRefundRequest;
use App\Http\Resources\RefundResource;
use App\Models\Refund;
use App\Traits\ApiResponse;
use Domain\Refunds\Actions\CreateRefundAction;
use Domain\Refunds\DataTransferObjects\RefundData;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RefundController extends Controller
{
    use ApiResponse;
    public CreateRefundAction $createRefundAction;

    public function __construct(CreateRefundAction $createRefundAction)
    {
        $this->createRefundAction = $createRefundAction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRefundRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRefundRequest $request): \Illuminate\Http\JsonResponse
    {
        $validatedRequest = $request->validated();
        $newRefundDto = RefundData::fromrequest($validatedRequest);
        $newRefundCreated = ($this->createRefundAction)($newRefundDto);

        return $this->success([RefundResource::make($newRefundCreated)],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Refund  $refund
     * @return Response
     */
    public function show(Refund $refund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Refund  $refund
     * @return Response
     */
    public function edit(Refund $refund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Refund  $refund
     * @return Response
     */
    public function update(Request $request, Refund $refund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Refund  $refund
     * @return Response
     */
    public function destroy(Refund $refund)
    {
        //
    }
}
