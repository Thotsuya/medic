<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;

class OdontogramRequest extends FormRequest
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
            'boton' => 'required',
            'nombtrata' => 'required',
            'classbtn1' => 'required',
            'classbtn2' => 'required',
            'classbtn3' => 'required',
            'classbtn4' => 'required',
            'classbtn5' => 'required',
            'classbtn6' => 'required',
            'classbtn7' => 'required',
            'classbtn8' => 'required',
            'classbtn9' => 'required',
            'classbtn10' => 'required',
            'classbtn11' => 'required',
            'classbtn12' => 'required',
            'classbtn13' => 'required',
            'classbtn14' => 'required',
            'classbtn15' => 'required',
            'classbtn16' => 'required',
            'classbtn17' => 'required',
            'classbtn18' => 'required',
            'patient_id' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'boton' => $this->area2,
            'nombtrata' => $this->anotaciones,
            'patient_id' => $this->idpaciente,
        ]);
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated(),[
            'patient_id' => Patient::where('uuid',$this->idpaciente)->first()->id,
        ]);
    }
}
