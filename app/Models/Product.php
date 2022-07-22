<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, Uuids;
    public $incrementing = false;

    protected $fillable = [
        'label',
        'price',
        'user_id'
    ];

    public function owner() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}