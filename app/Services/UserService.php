<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {

    public function getUser() {
        return Auth::user();
    }
}
