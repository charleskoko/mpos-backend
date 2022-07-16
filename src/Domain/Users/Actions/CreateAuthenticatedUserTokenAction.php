<?php

namespace Domain\Users\Actions;

use App\Models\User;

class CreateAuthenticatedUserTokenAction
{

    public function __invoke(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }

}
