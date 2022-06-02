<?php

namespace App\Http\Requests;

use App\Services\CurrencyService;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ValuationRequest extends FormRequest
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
            'patient_id' => 'required|exists:patients,id',
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'price' => 'required|numeric',
            'price_USD' => 'required|numeric',
            'observations' => 'nullable|string',
            'procedures' => 'array',
            'procedures.*.id' => 'exists:procedures,id',
            'procedures.*.amount' => 'required|numeric',
            'procedures.*.discount' => 'required|numeric|min:0|max:100',
            'procedures.*.price' => 'required|numeric',
            'procedures.*.price_USD' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'El paciente es requerido',
            'patient_id.exists' => 'El paciente no existe',
            'description.required' => 'El asunto del tratamiento es requerido',
            'description.string' => 'El asunto del tratamiento debe ser un texto',
            'start_date.required' => 'La fecha de inicio del tratamiento es requerida',
            'start_date.date' => 'La fecha de inicio del tratamiento debe ser una fecha',
            'price.required' => 'El precio del tratamiento es requerido',
            'price.numeric' => 'El precio del tratamiento debe ser un número',
            'observations.string' => 'Las observaciones del tratamiento deben ser un texto',
            'procedures.array' => 'Los procedimientos del tratamiento deben ser un arreglo',
            'procedures.*.id.exists' => 'Uno de los procedimientos del tratamiento no existe',
            'procedures.*.amount.required' => 'La cantidad para cada procedimiento del tratamiento es requerida',
            'procedures.*.amount.numeric' => 'La cantidad para cada procedimiento del tratamiento debe ser un número',
            'procedures.*.discount.required' => 'El descuento para cada procedimiento del tratamiento es requerido',
            'procedures.*.discount.numeric' => 'El descuento para cada procedimiento del tratamiento debe ser un número',
            'procedures.*.discount.min' => 'El descuento para cada procedimiento del tratamiento debe ser mayor o igual a 0',
            'procedures.*.discount.max' => 'El descuento para cada procedimiento del tratamiento debe ser menor o igual a 100',
        ];
    }

    protected function prepareForValidation()
    {
        $currency = new CurrencyService();
        $this->merge([
            'start_date' => Carbon::parse($this->start_date),
            'user_id' => auth()->id(),
            'price' => $currency->getAmountInBaseCurrency($this->price),
            'price_USD' => $currency->getAmountInTargetCurrency($this->price)
        ]);
    }
}
