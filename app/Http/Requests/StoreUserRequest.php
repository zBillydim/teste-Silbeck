<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'id_hotel' => 'nullable|exists:hotels,id',
            'phone' => 'nullable|string|max:20',
            'cellphone' => 'required|string|max:20',
            'cpf' => 'nullable|string|size:14',
            'rg' => 'nullable|string|size:12',
            'address' => 'nullable|string|max:255',
            'role' => 'nullable|in:guest,receptionist,admin,master',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        if ($this->has('cpf')) {
            $cpf = preg_replace('/\D/', '', $this->cpf);
            $this->merge([
                'cpf' => $this->formatCpfOrRg($cpf),
            ]);
        }
        if ($this->has('rg')) {
            $rg = preg_replace('/\D/', '', $this->rg);
            $this->merge([
                'rg' => $this->formatCpfOrRg($rg),
            ]);
        }
    }
    

    /**
     * Format CPF or RG to the desired pattern.
     *
     * @param  string  $cpf
     * @return string
     */
    private function formatCpfOrRg(string $string): string
    {
        if(strlen($string) == 14) return substr($string, 0, 2) . '.' . substr($string, 2, 3) . '.' . substr($string, 5, 3) . '-' . substr($string, 8, 1);
        return substr($string, 0, 3) . '.' . substr($string, 3, 3) . '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
    }

    /**
     * Custom error messages.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already taken',
            'cellphone' => 'Cellphone is required',
            'cpf.size' => 'CPF must be 14 characters, format: 000.000.000-00',
            'rg.size' => 'RG must be 12 characters, format: 00.000.000-0',
            'role.in' => 'Role is invalid',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 403));
    }
}
