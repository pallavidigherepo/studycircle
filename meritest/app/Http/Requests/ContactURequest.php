<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactURequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'mobile_no' => 'required',
            'address' => 'required',
            'heard_from' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ];
    }
}
