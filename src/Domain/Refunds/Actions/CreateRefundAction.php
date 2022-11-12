<?php

namespace Domain\Refunds\Actions;

use App\Models\Refund;
use Domain\Refunds\DataTransferObjects\RefundData;

class CreateRefundAction
{
    public function __invoke(RefundData $refundData): Refund
    {
        return Refund::create(
            [
                'reason' => $refundData->reason,
                'amount_refunded' => $refundData->amountRefunded,
                'order_id' => $refundData->orderId,
            ]
        );
    }
}
