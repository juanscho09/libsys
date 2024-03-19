<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends BaseRequest
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
            'title' => ['required', Rule::unique('books')->whereNull('deleted_at')],
            'publication_date' => 'required',
            'author' => 'required',
            'category' => 'required'
        ];
    }

    public function messages(){
        return [
            "title.required" => "El titulo es requerido.",
            "title.unique" => "El libro ya existe.",
            "publication_date.required" => "La fecha de publicación es requerida.",
            "author.required" => "El nombre del autor es requerido.",
            "category.required" => "La categoría del libro es requerida."
        ];
    }
}
