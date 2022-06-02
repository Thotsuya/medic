<?php

namespace App\Http\Requests;

use App\Services\CurrencyService;
use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attention_id' => 'required|integer|exists:attentions,id',
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required','numeric'],
            'currency' => ['required'],
            'unformatted_amount' => ['required','numeric'],
            'amount_USD' => ['required','numeric'],
            'description' => ['required','string'],
        ];
    }

    public function messages()
    {
        return [
          'amount.min' => 'El monto debe ser mayor a 0',
          'amount.numeric' => 'El monto debe ser un número',
          'amount.required' => 'El monto es requerido',
          'attention_id.exists' => 'El plan de tratamiento seleccionado no existe',
        ];
    }

    protected function prepareForValidation()
    {
        $currency = new CurrencyService();
        $this->merge([
            'currency' => $currency->getPriceSymbol(),
            'unformatted_amount' => $this->amount,
            'amount' => $currency->getAmountInBaseCurrency($this->amount),
            'amount_USD' => $currency->getAmountInTargetCurrency($this->amount)
        ]);
    }
}
