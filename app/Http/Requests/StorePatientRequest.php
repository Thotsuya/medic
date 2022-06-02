<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'document' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required|numeric',
            'observations' => 'sometimes',
            'tutor' => 'sometimes',
            'birthdate' => 'required|date'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'birthdate' => Carbon::parse($this->birthdate)->setTimezone('America/El_Salvador')->format('Y-m-d H:i:s')
        ]);
    }
}
