<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    public function createUser ($name, $email, $password) {
        return User::create(['name' => $name, 'email' => $email, 'password' => $password]);
    }

    public function getUser ($userID) {
        return User::where('id', $userID)->select('id', 'name', 'email')->first();
    }
}
