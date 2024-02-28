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
            'name.required' => 'Name é obrigatóro',
            'name.string' => 'Nome deve ser do tipo string',
            'email.required' => 'Email é obrigatóro',
            'email.regex' => 'Email deve ser um endereço válido',
            'cpf.required' => 'CPF é obrigatóro',
            'cpf.string' => 'CPF deve ser do tipo string',
            'cpf.regex' => 'CPF deve ser válido',
            'password.required' => 'Senha é obrigatóra',
            'password.min' => 'Senha deve conter no mínimo 7 caracteres',
            'password.regex' => 'Senha deve conter obrigatóriamente 1 letra maiúscula, 1 letra minúscula e 1 número ou caracter especial.',
            'isAdmin' => 'isAdmin deve ser do tipo booleano',
            'balance.prohibited' => 'Este campo não pode ser incluído na criação do usuário.',
        ];
    }
}
