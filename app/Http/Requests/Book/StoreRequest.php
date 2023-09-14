<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // NOTE: Don't change fields order as it used to make DTO object in this exact order 
            'name' => ['required', 'unique:books,name', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'items_in_stock' => ['required', 'integer'],
            'release_year' => ['required', 'integer'],
            'translator' => ['nullable', 'string'],
            'genre_id' => ['required', 'exists:genres,id'],
            'authors' => ['required', 'exists:authors,id'],
            'file' => ['nullable', 'mimes:jpg,jpeg,png'],
        ];
    }
}
