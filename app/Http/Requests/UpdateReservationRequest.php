<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_room' => 'nullable|exists:rooms,id',
            'id_user' => 'nullable|exists:users,id',
            'id_hotel' => 'nullable|exists:hotels,id',
            'checkin' => 'nullable|date',
            'checkout' => 'nullable|date|after_or_equal:checkin',
            'status' => 'nullable|in:pending,confirmed,canceled',
            'total_price' => 'nullable|numeric',
            'unit_price' => 'nullable|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'id_room.exists' => 'The room ID must exist in the rooms table.',
            'id_user.exists' => 'The user ID must exist in the users table.',
            'id_hotel.exists' => 'The hotel ID must exist in the hotels table.',
            'checkin.date' => 'The checkin date must be a valid date in the format YYYY-MM-DD.',
            'checkout.date' => 'The checkout date must be a valid date in the format YYYY-MM-DD.',
            'checkout.after_or_equal' => 'The checkout date must be after or equal to the checkin date in the format YYYY-MM-DD.',
            'status.in' => 'The status must be pending, confirmed, or canceled.',
            'total_price.numeric' => 'The total price must be a number.',
            'unit_price.numeric' => 'The unit price must be a number.',
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
