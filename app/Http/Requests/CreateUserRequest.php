<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'regex:/\S+@\S+\.\S+/'],
            'cpf' => ['required', 'string', 'regex:/^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/'],
            'password' => ['required', 'min:7', 'regex:/((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/i'],
            'isAdmin' => ['boolean'],
            'balance' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is mandatory',
            'name.string' => 'Name must be of type string',
            'email.required' => 'Email is mandatory',
            'email.regex' => 'Email must be a valid address',
            'cpf.required' => 'CPF is mandatory',
            'cpf.string' => 'CPF must be of type string',
            'cpf.regex' => 'CPF must be valid',
            'password.required' => 'Password is mandatory',
            'password.min' => 'Password must contain at least 7 characters',
            'password.regex' => 'Password must contain 1 uppercase letter, 1 lowercase letter and 1 number or special character',
            'isAdmin' => 'isAdmin must be of boolean type',
            'balance.prohibited' => 'This field cannot be included in user creation',
        ];
    }
}
