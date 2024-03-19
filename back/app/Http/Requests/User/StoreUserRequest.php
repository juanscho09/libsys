<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 
                Rule::unique('users')->whereNull('deleted_at')],
            //'password' => 'required'
        ];
    }

    public function messages(){
        return [
            "name.required" => "El nombre es requerido.",
            "email.required" => "El email es requerido.",
            "password.required" => "La contraseña es requerida.",
            "password.confirmed" => "Las contraseñas deben coincidir.",
            "email.unique" => "El email esta en uso.",
            "email.string" => "El email debe tener el formato correcto.",
            "email.email" => "El email debe tener el formato correcto abc@domain.com",
            "email.max" => "El email debe tener como máximo 255 caracteres.",
        ];
    }
}
