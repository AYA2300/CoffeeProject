<?php

namespace App\Http\Requests\Coffee;

use Illuminate\Foundation\Http\FormRequest;

class Add_Request extends FormRequest
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
            'name' => 'required|string',
            'base_price' => 'required|numeric',
            'image_url' => 'required|file|image|mimes:png,jpg,jpeg,jfif|max:10000',
            'store_ids' => 'required|array', // قائمة المتاجر المرتبطة بالقهوة
            'store_ids.*' => 'exists:stores,id', // تحقق من أن المتاجر موجودة

        ];
    }
}
