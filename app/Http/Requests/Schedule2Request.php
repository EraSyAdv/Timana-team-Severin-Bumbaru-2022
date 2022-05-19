<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Schedule2Request extends FormRequest
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

    public function messages()
    {
        return [
            'university.required' => 'Facultate incorecta !',
            'university.min' => 'Facultate incorecta !',
            'university.numeric' => 'Facultate incorecta !',

            'name.required' => 'Trebuie sa iti introduci numele !',
            'name.string' => 'Caractere incorecte !',

            'mail.required' => 'Trebuie iti introduci o adresa de mail !',
            'mail.email' => 'Trebuie introduci o adresa de mail valida !',

            'phone.required' => 'Trebuie sa introduci un numar de telefon valid !',
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
            'university' => 'required|min:0|numeric',
            'name' => 'required|string',
            'mail' => 'required|email',
            'phone' => 'required|string'
        ];
    }
}
