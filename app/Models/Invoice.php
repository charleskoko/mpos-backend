<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Invoice extends Model
{
    use HasApiTokens, HasFactory, Uuids;

    public $incrementing = false;

    public const CASH_PAYMENT = 'CASH';
    public const ORANGE_PAYMENT = 'ORANGE';
    public const MTN_PAYMENT = 'MTN';
    public const MOOV_PAYMENT = 'MOOV';
    public const WAVE_PAYMENT = 'WAVE';
    public const OTHER_PAYMENT = 'OTHER';

    protected $fillable = [
        'number',
        'user_id',
        'order_id',
        'payment',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
