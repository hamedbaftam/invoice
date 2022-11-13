<?php

namespace Modules\Invoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $isPost = request()->isMethod('post');
        return [
            'customerId' => [
                $isPost ? 'required' : 'nullable',
                Rule::exists('customers', 'id')->where(function ($query) {
                    $query->where('active', 1);
                }),
            ],
            'products.*.id' => [
                'required',
                Rule::exists('products', 'id')->where(function ($query) {
                    $query->where('active', 1);
                }),
            ],
            'products.*.quantity' => 'required|integer',
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

    public function messages()
    {
        return [
            "customerId.exists" => 'کاربر انتخاب شده غیرفعال یا نامعتبر می باشد.',
            "products.*.id.exists" => 'کالای انتخاب شده غیرفعال یا نامعتبر می باشد.'
        ];
    }
}
