<?php

namespace App\Repositories;

use App\User;

/**
 * Class UserRepository
 *
 * @package \App\Repositories
 */
class UserRepository
{
    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function createUser(array $attributes)
    {
        $data = [
            'confirmation_token' => str_random(40),
            'api_token' => str_random(60),
            'settings' => ['city' => ''],
            'is_active' => 1
        ];
        $attributes = array_merge($data, $attributes);
        return User::firstOrCreate($attributes);
    }

    public function getUserByEmail($email)
    {
        return User::where('email',$email)->first();
    }
}
