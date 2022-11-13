<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
                'boolean'
            ],
            'firstName' => [
                'string',
                'max:50'
            ],
            'lastName' => [
                'string',
                'max:50'
            ],
            'socialId' => [
                'digits:10',
            ],
            'birthday' => [
                'string'
            ],
            'mobileNumber' => [
                'digits_between:11,15'
            ],
            'mobileNumberDescription' => [
                'string',
                'max:100'
            ],
            'email' => [
                'string',
                'max:100'
            ],
            'emailDescription' => [
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
