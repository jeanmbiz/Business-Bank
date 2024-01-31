<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepositRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // id do usuário autenticado seja igual ao id do usuário da rota
        return auth()->user()->id == $this->route('id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'value'=> ['required','numeric', 'gte:0.01'],
        ];
    }

    public function messages(): array {
        return [
            'value.required' => 'O valor é obrigatório',
            'value.numeric' => 'O valor deve ser um número',
            'value.gte' => 'O valor deve ser maior ou igual a 0.01',
        ];
    }
}