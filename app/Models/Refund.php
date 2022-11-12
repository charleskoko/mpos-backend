<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Refund extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;


    public const ITEM_RETURNED_REASON = 'returned_item';
    public const ACCIDENTAL_COLLECTION_REASON = 'accidental_collection';
    public const CANCELED_REASON = 'canceled_order';
    public const OTHER_REASON = 'other';
    public const REASONS = [self::ITEM_RETURNED_REASON, self::ACCIDENTAL_COLLECTION_REASON, self::CANCELED_REASON, self::OTHER_REASON];
    protected $fillable = [
        'reason',
        'amount_refunded',
        'order_id',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
