<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TextRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'en'            => 'required|array',
            'de'            => 'required|array',
            'codename'      => 'required|string|max:255',
            'en.name'       => 'required|string|max:255',
            'en.slug'       => 'string|max:255',
            'de.name'       => 'required|string|max:255',
            'de.slug'       => 'string|max:255',
        ];
    }
}
