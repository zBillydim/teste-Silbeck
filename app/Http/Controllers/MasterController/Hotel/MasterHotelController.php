<?php

namespace App\Http\Controllers\MasterController\Hotel;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Controllers\Controller;

class MasterHotelController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $hotels = Hotel::all();
        if($request->id){
            $hotels = Hotel::find($request->id);
        }
        if(!$hotels){
            return response()->json([
                'success' => false,
                'errors' => 'Hotel not found',
                'message' => 'Hotel not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'errors' => '',
            'message' => 'Hotel found',
            'data' => $hotels
        ]);

    }
    public function store(StoreHotelRequest $request):JsonResponse
    {
        $validated = $request->validated();
        $hotel = new Hotel();
        $hotel->fill($validated);
        $hotel->save();
        return response()->json([
            'success' => true,
            'errors' => '',
            'message' => 'Hotel registration success'
        ], 201);
    }
    public function update(UpdateHotelRequest $request, int $id): JsonResponse
    {
        $hotel = Hotel::find($id);
        if(!$hotel){
            return response()->json([
                'success' => false,
                'errors' => 'Hotel not found',
                'message' => 'Hotel not found'
            ], 404);
        }
        $validated = $request->validated();
        $hotel->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Hotel updated successfully',
            'data' => $hotel,
        ], 200);
    }
    public function delete(Request $request){
        $hotel = Hotel::find($request->id);
        if(!$hotel){
            return response()->json([
                'success' => false,
                'errors' => 'Hotel not found',
                'message' => 'Hotel not found'
            ], 404);
        }
        $hotel->delete();
        return response()->json([
            'success' => true,
            'errors' => '',
            'message' => 'Hotel deleted successfully'
        ],200);
    }
}   
