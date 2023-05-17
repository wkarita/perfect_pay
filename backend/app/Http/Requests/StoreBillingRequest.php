<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreBillingRequest extends FormRequest
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
        $yesterday = Carbon::yesterday()->toDateString();

        return [
            'customer' => ['required', 'string', 'regex:/^cus_\d{12}$/'],
            'billingType' => ['required', 'string', 'in:BOLETO,CREDIT_CARD,PIX'],
            'value' => ['required', 'numeric'],
            'dueDate' => ['required', 'string', "after:$yesterday"],
            'cardName' => ['required_if:billingType,CREDIT_CARD', 'min:3', 'max:255'],
            'cardCpfCnpj' => ['required_if:billingType,CREDIT_CARD', 'regex:/^(\\d{3}\\.\\d{3}\\.\\d{3}\\-\\d{2}|\\d{2}\\.\\d{3}\\.\\d{3}\\/\\d{4}\\-\\d{2})$/'],
            'cardEmail' => ['required_if:billingType,CREDIT_CARD', 'email'],
            'cardPhone' => ['required_if:billingType,CREDIT_CARD'],
            'cardPostalCode' => ['required_if:billingType,CREDIT_CARD', 'regex:/^\\d{5}-\\d{3}$/'],
            'cardAddressNumber' => ['required_if:billingType,CREDIT_CARD', 'min:1','max:5'],
            'holderName' => ['required_if:billingType,CREDIT_CARD', 'min:3', 'max:255'],
            'number' => ['required_if:billingType,CREDIT_CARD', 'max:19'],
            'expiryDate' => ['required_if:billingType,CREDIT_CARD', 'min:7','max:7'],
            'ccv' => ['required_if:billingType,CREDIT_CARD', 'min:3','max:3'],
        ];
    }
}
