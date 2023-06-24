<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [];
        foreach (locales() as $key => $language) {
            $rules['title_' . $key] = 'required|string|max:255';
            $rules['info_' . $key] = 'required|string|max:255';
            $rules['description_' . $key] = 'required|string';
        }
        // $rules['feature_cover'] = 'required';
        $rules['category_id'] = 'required';

        return $rules;
    }


    public function messages()
    {
        $messages = [
            'info_ar.required' => 'يرجى تقديم وصف قصير بالعربية',
            'info_de.required' => 'يرجى تقديم وصف قصير بالألمانية',
            'title_ar.required' => 'يرجى تقديم العنوان بالعربية',
            'title_de.required' => 'يرجى تقديم العنوان بالألمانية',
            'description_ar.required' => 'يرجى تقديم الوصف بالعربية',
            'description_de.required' => 'يرجى تقديم الوصف بالألمانية',
            'feature_cover.required' => 'اضافة الصورة مطلوب',
            'category_id.required' => ' التصنيف مطلوب',
        ];


        return $messages;
    }
}
