<?php

namespace App\Http\Controllers\RecepcionistController\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecepcionistUserController extends Controller
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
