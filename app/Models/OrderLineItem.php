<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class OrderLineItem extends Model
{
    use HasApiTokens, HasFactory, Uuids;

    public $incrementing = false;


    protected $fillable = [
        'product_id',
        'product_label',
        'note',
        'order_id',
        'price',
        'amount'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return  $this->belongsTo(Product::class);
    }
}
