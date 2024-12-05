<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService {
    protected $userRepository;

    public function __construct (UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function createUser ($name, $email, $password) {
        $result = $this->userRepository->createUser($name, $email, $password);
        return ['message' => 'Signed in', 'result' => $result, 'status' => 201];
    }
}