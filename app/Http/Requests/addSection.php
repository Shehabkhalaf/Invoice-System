<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class addSection extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /*public function failedValidation(Validator $validator)
    {
        session()->flash('error', 'خطأ الاسم مسجل مسبقا');
        return redirect('/sections');
    }*/
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'section_name' => 'required|unique:sections,section_name',
            'description' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'section_name.required' => 'يرجى ادخال اسم القسم',
            'section_name.unique' => 'اسم الفسم مسحل مسبقا',
            'description.required' => 'يرجى ادخال وصف القسم'
        ];
    }
}