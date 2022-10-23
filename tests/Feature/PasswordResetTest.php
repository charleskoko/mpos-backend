<?php

namespace Tests\Feature;

use App\Mail\SendCodeResetPassword;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testUserReceiveResetPasswordCode(){
        Mail::fake();
        $user = User::factory()->create();
        $data = ['email' => $user->email];
        $response =  $this->post(route('password.email'),$data);
        $response->assertOk();
        Mail::assertSent(SendCodeResetPassword::class);
    }


    public function testUserResetPassword(){
        $user = User::factory()->create();
        $data = ['email' => $user->email];
        $response =  $this->post(route('password.email'),$data);
        $resetPasswordCode = ResetCodePassword::all()->first();
        $data = ["code" => $resetPasswordCode->code, "password" => "Abidjan225", "password_confirmation" =>"Abidjan225"];
        $response = $this->post(route('code.check'),$data);
        $response->assertOk();
    }

}
