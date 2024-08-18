<?php

namespace App\Http\Controllers\GuestController\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateUserRequest;

class GuestUserController extends Controller
{
    public function index()
    {
        $user = Auth::user()->toArray();
        return response()->json([
            'success' => true,
            'errors' => '',
            'message' => 'User found',
            'data' => $user
        ]);
    }
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $user = Auth::user();
        $validated = $request->validated();
        $user->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ], 200);
    }
    public function delete()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully, and all tokens revoked.',
        ], 200);
    }
}
