<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_room' => 'required|exists:rooms,id',
            'id_user' => 'required|exists:users,id',
            'id_hotel' => 'required|exists:hotels,id',
            'checkin' => 'required|date',
            'checkout' => 'nullable|date|after_or_equal:checkin',
            'status' => 'required|in:pending,confirmed,canceled',
            'total_price' => 'nullable|numeric',
            'unit_price' => 'required|numeric',
        ];
    }
    public function messages():array
    {
        return [
            'id_room.required' => 'The room id is required',
            'id_room.exists' => 'The room id must exist in the rooms table',
            'id_user.required' => 'The user id is required',
            'id_user.exists' => 'The user id must exist in the users table',
            'id_hotel.required' => 'The hotel id is required',
            'id_hotel.exists' => 'The hotel id must exist in the hotels table',
            'checkin.required' => 'The checkin date is required',
            'checkin.date' => 'The checkin date must be a valid date in the format YYYY-MM-DD.',
            'checkout.date' => 'The checkout date must be a valid date in the format YYYY-MM-DD.',
            'checkout.after_or_equal' => 'The checkout date must be after or equal to the checkin date in the format YYYY-MM-DD.',
            'status.required' => 'The status is required',
            'status.in' => 'The status must be pending, confirmed or canceled',
            'total_price.numeric' => 'The total price must be a number',
            'unit_price.required' => 'The unit price is required',
            'unit_price.numeric' => 'The unit price must be a number',
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
