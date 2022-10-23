<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetCodePassword extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $fillable = [
        'email',
        'code',
    ];
}
