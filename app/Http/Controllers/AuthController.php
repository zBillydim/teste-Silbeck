<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    public function index(LoginUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        if (!$user || !\Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'errors' => 'Invalid email or password',
                'message' => 'Login failed!'
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'success' => true,
            'errors' => '',
            'message' => 'Login success',
            'token' => $token
        ]);

    }
    public function store(StoreUserRequest $request): JsonResponse
    {   
        $validated = $request->validated();
        $user = new User();
        $user->fill($validated);
        $user->save();
        return response()->json([
            'success' => true,
            'errors' => '',
            'message' => 'User registration success!'
        ], 201);
    }
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
