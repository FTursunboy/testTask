<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\User;
use App\Services\AuthService;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) : SuccessResponse {
        $data = $request->validated();

        $user = $this->authService->register($data);

        return new SuccessResponse
        ([
            'user' => new UserResource($user),
            'message' => 'Success'
        ]);
    }


    public function login(LoginRequest $request) : SuccessResponse|ErrorResponse {

        $user = $this->authService->login($request->validated());


        if ($user) {
            return new SuccessResponse([
                'user' => new UserResource($user['user']),
                'token' => $user['token'],
                'message' => 'Success'
            ]);
        }

        return new ErrorResponse(
            status: 401
        );
    }

    public function logout() : SuccessResponse {
        $this->authService->logoutUser();

        return new SuccessResponse([
            'message' => 'Success'
        ]);
    }

}
