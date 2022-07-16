<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| Api Response Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

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
