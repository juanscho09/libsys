<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;

class UpdateUserRequest extends StoreUserRequest
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
        $rules = parent::rules();
        $rules['email'] = [
            'required', 'string', 'email', 'max:255', 
            Rule::unique('users')->ignore($this->user)->whereNull('deleted_at')
        ];
        //$rules['password'] = 'required';
        
        return $rules;
    }

    public function messages(){
        $messages = parent::messages();
        $messages['password.required'] = "La contraseña es requerida.";
        
        return $messages;
    }
}
