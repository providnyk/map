<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesignRequest extends FormRequest
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
            'enabled'			=> 'boolean',
#            'uk'       => 'required|array',
#            'ru'       => 'required|array',
            'en'       => 'required|array',
            'de'       => 'required|array',
            'uk'       => 'required|array',
            'uk.name'			=> 'required|string|max:255',
            'uk.description'  => 'string|max:255',
            'en.name'			=> 'required|string|max:255',
            'en.description'  => 'string|max:255',
            'de.name'			=> 'required|string|max:255',
            'de.description'  => 'string|max:255',
        ];
    }
}
