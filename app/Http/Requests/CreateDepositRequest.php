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
            'receiverCpf' => ['required', 'string', 'regex:/^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/'],
            'value' => ['required', 'numeric', 'gte:0.01'],
            'payerCpf' => ['string', 'regex:/^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'receiverCpf.required' => 'CPF é obrigatóro',
            'receiverCpf.string' => 'CPF deve ser do tipo string',
            'receiverCpf.regex' => 'CPF deve ser válido',
            'value.required' => 'O valor é obrigatório',
            'value.numeric' => 'O valor deve ser um número',
            'value.gte' => 'O valor deve ser maior ou igual a 0.01',
            'payerCpf.string' => 'CPF deve ser do tipo string',
            'payerCpf.regex' => 'CPF deve ser válido',
        ];
    }
}
