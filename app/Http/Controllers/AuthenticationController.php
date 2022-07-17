<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserPostRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Domain\Users\Actions\CreateAuthenticatedUserTokenAction;
use Domain\Users\Actions\CreateUserAction;
use Domain\Users\DataTransferObjects\UserData;
use Illuminate\Http\JsonResponse;
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

    public function register(UserPostRequest $request): JsonResponse
    {
        $validatedRequestData = $request->validated();
        $userData = UserData::fromRequest($validatedRequestData);
        $createdUser = ($this->createUserAction)($userData);
        $createdUserToken = ($this->createAuthenticatedUserTokenAction)($createdUser);

        return $this->success([
            'user' => UserResource::make($createdUser),
            'token' => $createdUserToken
        ]);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $userCredentials = $request->validated();

        if ($this->isUserCredentialFalse($userCredentials)) {
            return $this->error(401, null, 'Invalid login details');
        }
        $authenticationData = $this->userConnection($userCredentials['email']);

        return $this->success($authenticationData);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return $this->success(null, 200);
    }

    private function isUserCredentialFalse(array $userCredential): bool
    {
        return !Auth::attempt($userCredential);
    }


    private function userConnection(string $email): array
    {
        $user = User::where('email', $email)->firstOrFail();
        return [
            'user' => UserResource::make($user),
            'token' => ($this->createAuthenticatedUserTokenAction)($user)
        ];
    }
}
