<?php

namespace App\Http\Requests;

use App\Services\CurrencyService;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAttentionRequest extends FormRequest
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
            'procedures' => ['required'],
            'procedures.*.id' => ['required','exists:procedures,id'],
            'procedures.*.price' => ['required','numeric','min:0'],
            'procedures.*.price_USD' => ['required','numeric','min:0'],
            'procedures.*.amount' => ['required','numeric','min:0'],
            'procedures.*.discount' => ['required','numeric','min:0'],
        ];
    }


    protected function prepareForValidation()
    {
        $currency = new CurrencyService();
        $this->merge([
            'procedures' => collect($this->procedures)->map(function($procedure) use($currency) {
                return [
                  'id' => $procedure['id'],
                  'price' => $currency->getAmountInBaseCurrency($procedure['unformatted_price']),
                  'price_USD' => $currency->getAmountInTargetCurrency($procedure['unformatted_price']),
                  'amount' => $procedure['amount'],
                  'discount' => $procedure['discount'],
                ];
            })->values()->all(),
        ]);
    }

    public function messages()
    {
        return [
          'procedures.*.id.required' => 'El campo procedimiento es obligatorio.',
            'procedures.*.id.exists' => 'El procedimiento seleccionado no existe.',
            'procedures.*.price.required' => 'El campo precio es obligatorio.',
            'procedures.*.price.numeric' => 'El campo precio debe ser un número.',
            'procedures.*.price.min' => 'El campo precio debe ser mayor a 0.',
            'procedures.*.price_USD.required' => 'El campo precio en dólares es obligatorio.',
            'procedures.*.price_USD.numeric' => 'El campo precio en dólares debe ser un número.',
            'procedures.*.price_USD.min' => 'El campo precio en dólares debe ser mayor a 0.',
            'procedures.*.amount.required' => 'El campo cantidad es obligatorio.',
            'procedures.*.amount.numeric' => 'El campo cantidad debe ser un número.',
            'procedures.*.amount.min' => 'El campo cantidad debe ser mayor a 0.',
            'procedures.*.discount.required' => 'El campo descuento es obligatorio.',
            'procedures.*.discount.numeric' => 'El campo descuento debe ser un número.',
            'procedures.*.discount.min' => 'El campo descuento debe ser mayor a 0.',

        ];
    }
}
