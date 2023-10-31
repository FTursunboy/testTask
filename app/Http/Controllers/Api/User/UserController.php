<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Responses\SuccessResponse;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile() : SuccessResponse {
        return new SuccessResponse([
            'user' => new UserResource($this->userService->getUser()),
            'message' => 'User Profile'
        ]);
    }


}
