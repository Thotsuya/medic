<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,bpm,gif,svg'],
            'name' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'patient_id.required' => 'Debe seleccionar un paciente',
            'patient_id.exists' => 'El paciente seleccionado no existe',
            'file.required' => 'Debe seleccionar un archivo',
            'file.mimes' => 'El archivo a subir debe ser un archivo con formato: pdf, doc, docx, xls, xlsx, ppt, pptx, jpg, jpeg, png, bpm, gif, svg',
            'name.required' => 'Debe ingresar un título para el documento'
        ];
    }
}
