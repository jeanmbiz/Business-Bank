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
            'email'=>['required', 'email'],
            'name'=>['required'],
            'cpf'=>['required'],
            'name'=>['required'],
            'password'=>['required', 'min:7', 'regex:/[a-zA-Z]/i'],
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'Email é obrigatóro',
            'email.mail' => 'Email deve ser um endereço válido',
            'name.required' => 'Nome é obrigatóro',
            'cpf.required' => 'CPF é obrigatóro',
            'password.required' => 'Senha é obrigatóra',
            'password.min' => 'Senha deve conter mínimo 7 caracteres',
            'password.regex' => 'Senha deve ter xxx caracteres igual o regex'
        ];
    }
}
