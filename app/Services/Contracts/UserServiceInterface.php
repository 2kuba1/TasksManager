<?php

namespace App\Services\Contracts;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterUserRequest;

interface UserServiceInterface
{
    public function register(RegisterUserRequest $request) : void;
    public function login(LoginRequest $request) : array;
}
