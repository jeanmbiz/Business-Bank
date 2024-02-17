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
            'name' => ['required'],
            'email' => ['required', 'email'],
            'cpf' => ['required'],
            'password' => ['required', 'min:7', 'regex:/((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/i'],
            'isAdmin' => ['boolean'],
            'balance' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatóro',
            'email.required' => 'Email é obrigatóro',
            'email.mail' => 'Email deve ser um endereço válido',
            'cpf.required' => 'CPF é obrigatóro',
            'password.required' => 'Senha é obrigatóra',
            'password.min' => 'Senha deve conter mínimo 7 caracteres',
            'password.regex' => 'Senha deve ter obrigatóriamente 1 letra maiúscula, 1 letra minúscula e 1 número ou caracter especial.',
            'isAdmin' => 'O valor deve ser do tipo booleano',
            'balance.prohibited' => 'Este campo não pode ser incluído na criação do usuário.',
        ];
    }
}
