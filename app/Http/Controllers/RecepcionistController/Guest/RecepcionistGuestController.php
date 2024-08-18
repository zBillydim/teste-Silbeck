<?php

namespace App\Http\Controllers\RecepcionistController\Guest;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;

class RecepcionistGuestController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'guest')->get()->toArray();
        return response()->json([
            'success' => true,
            'errors' => '',
            'message' => 'User found',
            'data' => $users
        ]);
    }
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        if($validated['role'] != 'guest'){
            return response()->json([
                'success' => false,
                'errors' => 'Role must be guest',
                'message' => 'Role must be guest'
            ], 400);
        }
        $user = new User();
        $user->fill($validated);
        $user->save();
        return response()->json([
            'success' => true,
            'errors' => '',
            'message' => 'User registration success',
            'data' => $validated
        ], 201);
    }
    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        if(!$user || $user->role != 'guest'){
            return response()->json([
                'success' => false,
                'errors' => 'User not found or role not guest',
                'message' => 'User not found or role not guest'
            ], 404);
        }
        $user->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ], 200);
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if(!$user || $user->role != 'guest'){
            return response()->json([
                'success' => false,
                'errors' => 'User not found or role not guest',
                'message' => 'User not found or role not guest'
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }
}
