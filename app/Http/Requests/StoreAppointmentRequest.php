<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreAppointmentRequest extends FormRequest
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
            'start_date' => 'required|date',
            'color' => 'required',
            'title' => 'required',
            'end_date' => 'required|date',
            'textcolor' => 'required',
            'description' => 'sometimes'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => Patient::find($this->patient_id)->name,
            'start_date' => Carbon::parse($this->start_date)->setTimezone('America/El_Salvador')->format('Y-m-d H:i:s'),
            'end_date' => Carbon::parse($this->start_date),
            'textcolor' => '#ffffff',
        ]);
    }
}
