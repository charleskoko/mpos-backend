<?php

namespace App\Http\Controllers;

use App\Http\Resources\MetricResource;
use App\Models\User;
use App\Traits\ApiResponse;

class MetricsController extends Controller

{
    use ApiResponse;

    public function fetchMetrics()
    {
        $users = User::all();
        return $this->success([MetricResource::collection($users)]);
    }
}
