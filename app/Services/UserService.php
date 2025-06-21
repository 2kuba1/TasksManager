<?php

namespace App\Services;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserService implements UserServiceInterface
{

    public function register(RegisterUserRequest $request) : void
    {
        $validatedRequest = $request->validated();

       User::create([
           'id' => Str::uuid()->toString(),
           'name' => $validatedRequest['name'],
           'email' => $validatedRequest['email'],
           'password' => bcrypt($validatedRequest['password']),
       ]);
    }

    public function login(LoginRequest $request): array
    {
        $validatedRequest = $request->validated();

        $user = User::where('email', $validatedRequest['email'])->first();

        if(!$user)
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);

        if (!Hash::check($validatedRequest['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('laravel_api_token')->plainTextToken;

        return [
            "user"  => $user,
            "token" => $token,
        ];
    }
}
