<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CocktailRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'word' => 'nullable|string|max:255'
        ];
    }

    /**
     *
     *
     * @return array
     */
    public function messages()
    {
        return [
            'word.string' => 'Search word must be a string.',
            'word.max' => 'Search word cannot exceed 255 characters.',
        ];
    }
}
