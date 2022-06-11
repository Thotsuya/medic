<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserEditRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'password' => ['required', 'confirmed',Password::min(8)->mixedCase()->numbers()->letters()],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.max' => 'El nombre debe tener máximo 255 caracteres',
            'email.required' => 'El correo electrónico es requerido',
            'email.string' => 'El correo electrónico debe ser una cadena de texto',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida',
            'email.max' => 'El correo electrónico debe tener máximo 255 caracteres',
            'email.unique' => 'El correo electrónico ya está en uso',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.mixedCase' => 'La contraseña debe tener al menos una letra mayúscula',
            'password.numbers' => 'La contraseña debe tener al menos un número',
            'password.letters' => 'La contraseña debe tener al menos una letra',
            'role_id.required' => 'El rol es requerido',
            'role_id.exists' => 'El rol no existe',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated(),[
            'password' => bcrypt($this->password),
        ]);
    }
}
