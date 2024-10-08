<?php

namespace App\Http\Requests\additional_customizations;

use Illuminate\Foundation\Http\FormRequest;

class additional_customizationsRequest extends FormRequest
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
        'order_id'=>'nullable|exists:orders,id',
        'milk_type_id'=>'nullable|exists:milk_types,id',
        'coffee_type_id'=>'nullable|exists:coffee_types,id',
        'additives'=>'array',
        'syrup_id'=>'nullable|exists:syrups,id',
        'Roasting'=>'required|string',
        'Grinding'=>'required|string',
        ];
    }
}
