<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateCodeRequest;
use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    use ApiResponse;

    public function generateResetCode(GenerateCodeRequest $request)
    {
        $validatedRequest = $request->validated();
        ResetCodePassword::where('email', $validatedRequest['email'])->delete();
        $data['code'] = mt_rand(100000, 999999);
        $data['email'] = $validatedRequest['email'];
        $codeData = ResetCodePassword::create($data);
        Mail::to($validatedRequest['email'])->send(new SendCodeResetPassword($codeData->code));

        return $this->success(['message'=> 'password.reset']);
    }
}
