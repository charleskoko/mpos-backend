<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['email' => 'test.user@gmail.com',
            'name' => 'Test User',
            'password' => Hash::make('12345678')]);

        User::create(['email' => 'other.user@gmail.com',
            'name' => 'Other User',
            'password' => Hash::make('12345678')]);
    }
}
