<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            $rules['button_' . $key] = 'required_if:btn_required,on';
        }
        $rules['url'] = 'required_if:btn_required,on';
        // $rules['slider_cover'] = 'required';

        return $rules;
    }


    public function messages()
    {
        $messages = [
            'info_ar.required' => 'يرجى تقديم العنوان بالعربية',
            'info_de.required' => 'يرجى تقديم العنوان بالألمانية',
            'title_ar.required' => 'يرجى تقديم الوصف بالعربية',
            'title_de.required' => 'يرجى تقديم الوصف بالألمانية',
            'slider_cover.required' => 'اضافة الصورة مطلوب',
        ];

        if (request()->input('btn_required') === 'on') {
            $messages['url.required_if'] = 'رابط الزر مطلوب';
            $messages['button_ar.required_if'] = 'يرجى تقديم نص الزر بالعربية';
            $messages['button_de.required_if'] = 'يرجى تقديم نص الزر بالألمانية';
        }

        return $messages;
    }
}
