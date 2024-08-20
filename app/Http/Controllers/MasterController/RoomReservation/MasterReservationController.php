<?php
namespace App\Http\Controllers\MasterController\RoomReservation;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\RoomReservation;
use Illuminate\Http\Request;
class MasterReservationController extends Controller
{
    public function store(StoreReservationRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $reservation = new RoomReservation();
        $reservation->fill($validated);
        $reservation->save();
        return response()->json([
            'success' => true,
            'message' => 'Reservation created successfully',
            'data' => $reservation
        ], 201);
    }

    public function index(Request $request): JsonResponse
    {
        if($request->id){
            $reservations = RoomReservation::find($request->id);
            if(!$reservations){
                return response()->json([
                    'success' => false,
                    'message' => 'Reservation not found'
                ], 404);
            }
            return response()->json([
                'success' => true,
                'data' => $reservations
            ]);
        }
        $reservations = RoomReservation::get();
        if(count($reservations) == 0){
            return response()->json([
                'success' => false,
                'message' => 'No reservations found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $reservations
        ]);
    }
    public function update(UpdateReservationRequest $request, $id): JsonResponse
    {
        $reservation = RoomReservation::find($id);
        if(!$reservation){
            return response()->json([
                'success' => false,
                'message' => 'Reservation not found'
            ], 404);
        }
        $reservation->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Reservation updated successfully',
            'data' => $reservation
        ]);
    }

    public function delete($id): JsonResponse
    {
        $reservation = RoomReservation::find($id);
        if(!$reservation){
            return response()->json([
                'success' => false,
                'message' => 'Reservation not found'
            ], 404);
        }
        $reservation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reservation deleted successfully'
        ]);
    }

    public function cancel($id): JsonResponse
    {
        $reservation = RoomReservation::find($id);
        if(!$reservation){
            return response()->json([
                'success' => false,
                'message' => 'Reservation not found'
            ], 404);
        }
        $reservation->status = 'canceled';
        $reservation->save();
        return response()->json([
            'success' => true,
            'message' => 'Reservation canceled successfully',
            'data' => $reservation
        ]);
    }
}
