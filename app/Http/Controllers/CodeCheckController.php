<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeCheckingRequest;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;

class CodeCheckController extends Controller
{
    use ApiResponse;

    public function codeChecking(CodeCheckingRequest $request)
    {
        dd('dgdfg');
        $validatedRequest = $request->validated();
        $passwordReset = ResetCodePassword::firstWhere('code', $validatedRequest['code']);
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }
        $user = User::firstWhere('email', $passwordReset->email);
        $user->update(['password' => Hash::make($request)]);
        $passwordReset->delete();

        return response(['message' => 'password has been successfully reset'], 200);
    }
}