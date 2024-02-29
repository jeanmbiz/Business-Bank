<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['string'],
            'email' => ['regex:/\S+@\S+\.\S+/'],
            'cpf' => ['prohibited'],
            'password' => ['min:7', 'regex:/((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/i'],
            'isAdmin' => ['prohibited'],
            'balance' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Name must be of type string',
            'email.regex' => 'Email must be a valid address',
            'cpf.prohibited' => 'CPF cannot be changed',
            'password.min' => 'Password must contain at least 7 characters',
            'password.regex' => 'Password must contain 1 uppercase letter, 1 lowercase letter and 1 number or special character',
            'isAdmin.prohibited' => 'isAdmin cannot be changed',
            'balance.prohibited' => 'balance cannot be changed',
        ];
    }
}
