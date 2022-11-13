<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'active' => [
                'required',
                'boolean'
            ],
            'firstName' => [
                'required',
                'string',
                'max:50'
            ],
            'lastName' => [
                'required',
                'string',
                'max:50'
            ],
            'socialId' => [
                'required',
                'digits:10',
            ],
            'birthday' => [
                'required',
                'string'
            ],
            'mobileNumber' => [
                'required',
                'digits_between:11,15'
            ],
            'mobileNumberDescription' => [
                'required',
                'string',
                'max:100'
            ],
            'email' => [
                'required',
                'string',
                'max:100'
            ],
            'emailDescription' => [
                'required',
                'string',
                'max:100'
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
