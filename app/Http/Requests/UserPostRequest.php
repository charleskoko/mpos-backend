<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'required|regex:/^[0-9]{10}+$/',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'register_name_required',
            'name.string' => 'name_string',
            'name.max' => 'max',
            'email.required' => 'email_required',
            'email.email' => 'email_email',
            'email.max' => 'email_max',
            'email.unique' => 'email_unique',
            'mobile.required' => 'mobile_required',
            'mobile_regex' => 'mobile_regex',
            'password.string' => 'password_string',
            'password.min' => 'password_min',
            'password.required' => 'password_required',
            'password.confirmed' => 'password_confirmed',
        ];
    }
}
