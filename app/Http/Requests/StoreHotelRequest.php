<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreHotelRequest extends FormRequest
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
            'company_name' => 'required|string|max:255',
            'fantasy_name' => 'required|string|max:255',
            'cnpj' => 'required|string|size:18|unique:hotels,cnpj',
            'phone' => 'required|string|max:20',
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
            'company_name.required' => 'The company name is required.',
            'fantasy_name.required' => 'The fantasy name is required.',
            'cnpj.required' => 'The CNPJ is required.',
            'cnpj.size' => 'The CNPJ must be exactly 18 characters, format: XX.XXX.XXX/XXXX-XX.',
            'cnpj.unique' => 'The CNPJ has already been taken.',
            'phone.required' => 'The phone number is required.',
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
