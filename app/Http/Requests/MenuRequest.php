<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            $rules['name_' . $key] = 'required|string|max:255';
        }
        $rules['show_place'] = 'required';
        $rules['link'] = 'required';

        return $rules;
    }


    public function messages()
{
    $messages = [
        'name_ar.required' => 'يرجى تقديم الاسم بالعربية',
        'name_de.required' => 'يرجى تقديم الاسم بالألمانية',
    ];


    return $messages;
}

}
