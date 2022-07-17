<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    protected function success($data, int $code = 200): JsonResponse
    {
        return response()->json([
            'data' => $data
        ], $code);
    }

    protected function error(int $code, $data = null, string $message = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

}
