<?php

namespace Domain\Users\DataTransferObjects;

use Illuminate\Support\Facades\Hash;

class UserData
{
    public string $name;
    public string $email;
    public string $password;

    public static function fromRequest(array $validatedUserData): UserData
    {
        $dto = new self();
        $dto->name = $validatedUserData['name'];
        $dto->email = $validatedUserData['email'];
        $dto->password = Hash::make($validatedUserData['password']);

        return $dto;
    }
}
