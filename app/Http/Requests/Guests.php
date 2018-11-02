<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Guests extends FormRequest
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
            'guests' => 'required|numeric|max:255',
        ];
    }
}
