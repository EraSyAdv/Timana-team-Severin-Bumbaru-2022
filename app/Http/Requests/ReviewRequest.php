<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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

            'name.required' => 'Trebuie sa iti introduci numele !',
            'name.string' => 'Caractere incorecte !',

            'code.required' => 'Trebuie sa iti introduci codul de identificare !',
            'code.string' => 'Trebuie sa introduci un cod valid !',

            'text.required' => 'Trebuie sa introduci un text !',
            'text.string' => 'Caractere incorecte !',
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
            'name' => 'required|string',
            'code' => 'required|string',
            'text' => 'required|string'
        ];
    }
}
