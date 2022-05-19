<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    protected $redirect = '/';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'acceptance.required' => 'Trebuie sa alegi o optiune de admitere !',
            'acceptance.min' => 'Trebuie sa alegi o optiune de admitere !',
            'acceptance.max' => 'Trebuie sa alegi o optiune de admitere !',

            'speciality.required' => 'Trebuie sa alegi o optiune de specialitate !',
            'speciality.min' => 'Trebuie sa alegi o optiune de specialitate !',

            'city.required' => 'Trebuie sa alegi o optiune de oras !',
            'city.min' => 'Trebuie sa alegi o optiune de oras !',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'acceptance' => 'required|min:0|max:2|',
            'speciality' => 'required|min:1',
            'city' => 'required|min:1'
        ];
    }
}
