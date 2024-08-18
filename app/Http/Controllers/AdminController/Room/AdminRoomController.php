<?php

namespace App\Http\Controllers\AdminRoomController\Room;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AdminRoomController extends Controller
{
    public function index(): JsonResponse
    {
        $rooms = Room::all();
        return response()->json([
            'success' => true,
            'data' => $rooms
        ]);
    }
    public function store(StoreRoomRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $room = new Room();
        $room->fill($validated);
        $room->save();
        return response()->json([
            'success' => true,
            'message' => 'Room created successfully',
            'data' => $room
        ], 201);
    }
    public function show(Request $id): JsonResponse
    {
        $room = Room::find($id);
        if(!$room){
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $room
        ]);
    }
    public function update(UpdateRoomRequest $request, $id): JsonResponse
    {
        $room = Room::find($id);
        if(!$room){
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }
        $validated = $request->validated();
        $room->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Room updated successfully',
            'data' => $room
        ]);
    }
    public function delete($id): JsonResponse
    {
        $room = Room::find($id);
        if(!$room){
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }
        $room->delete();
        return response()->json([
            'success' => true,
            'message' => 'Room deleted successfully'
        ]);
    }
}