<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService {

    public function register(array $data) : User {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender']
        ]);
    }

    public function login(array $data): ?array
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user  = Auth::user();

            $token = $user->createToken("API TOKEN")->plainTextToken;

            return [
                'user' => $user,
                'access_token' => $token,
            ];
        }

        return null;
    }
    public function logoutUser() : bool
    {
        $user = Auth::user();
        $user->tokens()->delete();
        Auth::logout();

        return true;
    }
}
