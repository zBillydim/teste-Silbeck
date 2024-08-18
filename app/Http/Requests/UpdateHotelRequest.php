<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateHotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => 'nullable|string|max:255',
            'fantasy_name' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|size:18|unique:hotels,cnpj,' . $this->route('id'),
            'phone' => 'nullable|string|max:20',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'company_name.string' => 'The company name must be a string.',
            'company_name.max' => 'The company name may not be greater than 255 characters.',
            'fantasy_name.string' => 'The fantasy name must be a string.',
            'fantasy_name.max' => 'The fantasy name may not be greater than 255 characters.',
            'cnpj.string' => 'The CNPJ must be a string.',
            'cnpj.size' => 'The CNPJ must be exactly 18 characters.',
            'cnpj.unique' => 'The CNPJ has already been taken.',
            'phone.string' => 'The phone number must be a string.',
            'phone.max' => 'The phone number may not be greater than 20 characters.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
