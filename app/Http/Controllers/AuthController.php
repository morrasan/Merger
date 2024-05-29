<?php

namespace App\Http\Controllers;

use App\Services\Auth\AuthServiceSelector;
use App\Services\JWT\JWTService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    private AuthServiceSelector $authServiceSelector;

    public function __construct(AuthServiceSelector $authServiceSelector) {

        $this->authServiceSelector = $authServiceSelector;
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'failure',
            ]);
        }

        $login = $request->input('login');

        $password = $request->input('password');

        try {
            $authService = $this->authServiceSelector->select($login);

            if ($authService->authenticate($login, $password)) {

                $token = JWTService::generateToken($login, $authService->authSystemName);

                return response()->json([
                    'status' => 'success',
                    'token' => $token,
                ]);
            }

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'failure',
            ]);
        }

        return response()->json([
            'status' => 'failure',
        ]);
    }
}
