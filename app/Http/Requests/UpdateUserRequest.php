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
            'name.string' => 'Nome deve ser do tipo string',
            'email.regex' => 'Email deve ser um endereço válido',
            'cpf.prohibited' => 'O campo CPF não pode ser alterado.',
            'password.min' => 'Senha deve conter no mínimo 7 caracteres',
            'password.regex' => 'Senha deve conter obrigatóriamente 1 letra maiúscula, 1 letra minúscula e 1 número ou caracter especial.',
            'isAdmin.prohibited' => 'O campo isAdmin não pode ser alterado.',
            'balance.prohibited' => 'O campo balance não pode ser alterado.',
        ];
    }
}
