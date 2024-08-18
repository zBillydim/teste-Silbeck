<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_hotel' => 'nullable|exists:hotels,id',
            'room_number' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|in:available,occupied,maintenance',
        ];
    }
}
