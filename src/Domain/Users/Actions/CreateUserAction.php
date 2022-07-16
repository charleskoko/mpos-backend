<?php

namespace Domain\Users\Actions;

use App\Models\User;
use Domain\Users\DataTransferObjects\UserData;

class CreateUserAction
{
    public function __invoke(UserData $userData): User
    {
        return User::create(
            [
                'name' => $userData->name,
                'email' => $userData->email,
                'password' => $userData->password
            ]
        );

    }

}
