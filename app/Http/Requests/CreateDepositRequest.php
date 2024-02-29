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
            'receiverCpf.required' => 'receiverCpf is mandatory',
            'receiverCpf.string' => 'CPF must be of type string',
            'receiverCpf.regex' => 'CPF must be valid',
            'value.required' => 'The value is mandatory',
            'value.numeric' => 'The value must be a number',
            'value.gte' => 'The value must be greater than or equal to 0.01',
            'payerCpf.string' => 'CPF must be of type string',
            'payerCpf.regex' => 'CPF must be valid',
        ];
    }
}
