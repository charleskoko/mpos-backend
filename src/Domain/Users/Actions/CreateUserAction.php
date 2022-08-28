<?php

namespace Domain\Users\Actions;

use App\Models\User;
use Domain\Users\DataTransferObjects\UserData;

class CreateUserAction
{
    private DetermineUserUniqueNumber $determineUserUniqueNumber;

    public function __construct(DetermineUserUniqueNumber $determineUserUniqueNumber)
    {
        $this->determineUserUniqueNumber = $determineUserUniqueNumber;
    }

    public function __invoke(UserData $userData): User
    {

        return User::create(
            [
                'name' => $userData->name,
                'email' => $userData->email,
                'unique_number' =>($this->determineUserUniqueNumber)(),
                'password' => $userData->password
            ]
        );

    }

}
