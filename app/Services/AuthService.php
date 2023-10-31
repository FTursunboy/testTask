<?php


namespace App\Services;

use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService {

    public function register(array $data) : User {
        $password = $data['password'];

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender']
        ]);


        SendEmailJob::dispatch($user->email, $password);

        return $user;
    }

    public function login(array $data): ?array
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user  = Auth::user();

            $token = $user->createToken("API TOKEN")->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        }

        return null;
    }

    public function logoutUser() : bool
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return true;
    }
}
