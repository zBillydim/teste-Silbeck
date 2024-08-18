<?php

namespace App\Http\Controllers\MasterController\Room;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class MasterRoomController extends Controller
{
    public function index($id): JsonResponse
    {
        if($id){
            $rooms = Room::find($id);
            if(!$rooms){
                return response()->json([
                    'success' => false,
                    'message' => 'Room not found'
                ], 404);
            }
            return response()->json([
                'success' => true,
                'data' => $rooms
            ]);
        }
        $rooms = Room::all();
        if(!$rooms){
            return response()->json([
                'success' => false,
                'message' => 'No rooms found'
            ], 404);
        }
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
