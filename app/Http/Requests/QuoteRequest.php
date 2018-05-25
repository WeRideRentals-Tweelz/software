<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
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
            //Check if the name entered is not made by a robot
            'name'      =>      [
                'required',
                'regex:/^[a-zA-Z]{1,}\s?-?[a-zA-Z]{0,}\s?-?[a-zA-Z]*$/',
            ],
            'phone'     =>      'required|digits:10',
            'email'     =>      'required',
            'pickUp'    =>      'required',
            'dropOff'   =>      'required'
        ];
    }
}
