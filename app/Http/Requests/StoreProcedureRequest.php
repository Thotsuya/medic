<?php

namespace App\Http\Requests;

use App\Services\CurrencyService;
use Illuminate\Foundation\Http\FormRequest;

class StoreProcedureRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric',
            'price_USD' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser un número',
        ];
    }

    protected function prepareForValidation()
    {
        $currency = new CurrencyService();
        $this->merge([
            'price' => $currency->getAmountInBaseCurrency($this->price),
            'price_USD' => $currency->getAmountInTargetCurrency($this->price),
        ]);
    }
}
