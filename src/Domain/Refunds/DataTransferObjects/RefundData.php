<?php

namespace Domain\Refunds\DataTransferObjects;

class RefundData
{
    public string $orderId;
    public string $reason;
    public float $amountRefunded;

    public static function fromrequest(array $validatedRefundedData): RefundData
    {
        $dto = new self();
        $dto->orderId = $validatedRefundedData['order_id'];
        $dto->reason = $validatedRefundedData['reason'];
        $dto->amountRefunded = $validatedRefundedData['amount_refunded'];

        return $dto;
    }
}
