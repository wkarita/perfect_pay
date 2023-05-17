<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','min:3','max:255'],
            'cpfCnpj' => ['required', 'regex:/^(\\d{3}\\.\\d{3}\\.\\d{3}\\-\\d{2}|\\d{2}\\.\\d{3}\\.\\d{3}\\/\\d{4}\\-\\d{2})$/'],
            'postalCode' => ['required', 'regex:/^\\d{5}-\\d{3}$/'] ,
            'addressNumber' => ['required','min:1','max:5'] ,
        ];
    }
}
