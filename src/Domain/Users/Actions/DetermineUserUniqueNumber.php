<?php

namespace Domain\Users\Actions;

use App\Models\User;

class DetermineUserUniqueNumber
{
    public function __invoke():String
    {
        do {
            $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXY';
            $uniqueNumber = substr(str_shuffle($permitted_chars), 0, 3);
            $uniqueNumberVerification = User::where('unique_number', '=', $uniqueNumber)->first();
        } while ($uniqueNumberVerification != null);

        return $uniqueNumber;
    }

}
