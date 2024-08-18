<?php

namespace App\Http\Controllers\MasterController\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;

class MasterUserController extends Controller
{
    public function index($id)
    {
        $users = User::all()->paginate(10);
        if($id){
            $users = User::find($id);
        }
        if(!$users){
            return response()->json([
                'success' => false,
                'errors' => 'User not found',
                'message' => 'User not found'
            ], 404);
        }
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
        $validated = $request->validated();
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'success' => false,
                'errors' => 'User not found',
                'message' => 'User not found'
            ], 404);
        }
        $user->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ], 200);
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if(!$user){
            return response()->json([
                'success' => false,
                'errors' => 'User not found',
                'message' => 'User not found'
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }
}
