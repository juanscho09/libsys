<?php

namespace App\Http\Requests\Book;

use Illuminate\Validation\Rule;

class UpdateBookRequest extends StoreBookRequest
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
        $rules['title'] = ['required', Rule::unique('books')->ignore($this->book)->whereNull('deleted_at')];
        
        return $rules;
    }
}
