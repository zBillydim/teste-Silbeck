<?php

namespace App\Http\Controllers\AdminController\Hotel;

use App\Models\Hotel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminHotelController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();
        $hotels = Hotel::find($user->id_hotel);
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
}   
