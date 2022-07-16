<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Domain\Users\Actions\CreateAuthenticatedUserTokenAction;
use Domain\Users\Actions\CreateUserAction;
use Domain\Users\DataTransferObjects\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use ApiResponse;

    private CreateUserAction $createUserAction;
    private CreateAuthenticatedUserTokenAction $createAuthenticatedUserTokenAction;

    public function __construct(CreateUserAction $createUserAction, CreateAuthenticatedUserTokenAction $createAuthenticatedUserTokenAction)
    {
        $this->createUserAction = $createUserAction;
        $this->createAuthenticatedUserTokenAction = $createAuthenticatedUserTokenAction;
    }

    public function register(UserPostRequest $request)
    {
        $validatedData = $request->validated();
        $userData = UserData::fromRequest($validatedData);
        $createdUser = ($this->createUserAction)($userData);
        $createdUserToken = ($this->createAuthenticatedUserTokenAction)($createdUser);

        return $this->success([
            'user' => UserResource::make($createdUser),
            'token' => $createdUserToken
        ]);
    }
}
