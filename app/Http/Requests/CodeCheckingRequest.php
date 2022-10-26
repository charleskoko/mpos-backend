<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeCheckingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'code_required',
            'code.string' => 'code_string',
            'code.exists' => 'code_exists',
            'password.exists' => 'password_required',
            'password.string' => 'password_string',
            'password.min' => 'password_min',
            'password.confirmed' => 'password_confirmed',
        ];
    }
}
