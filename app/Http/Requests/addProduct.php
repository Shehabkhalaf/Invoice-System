<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addProduct extends FormRequest
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
            'product_name' => 'required',
            'section_id' => 'required',
            'description' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'product_name' => 'يرجى ادخال اسم المنتج',
            'section_id' => 'يرجى اختيار القسم',
            'description' => 'يرجى ادخال الوصف الخاص بالمنتج'
        ];
    }
}
