<?php

namespace App\Http\Requests\additional_customizations;

use Illuminate\Foundation\Http\FormRequest;

class add_Coffee_typeRequest extends FormRequest
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
            'name'=>'required|string',
            'coffee_country_id'=>'required|exists:coffee_countries,id'
        ];
    }
}
