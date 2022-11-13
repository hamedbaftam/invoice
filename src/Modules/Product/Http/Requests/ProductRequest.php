<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => $isPost ? 'required|string' : 'string',
            'active' => $isPost ? 'required|boolean' : 'boolean',
            'price' => $isPost ? 'required|integer' : 'integer',
            'tax' => $isPost ? 'required|numeric|between:0,100' : 'numeric|between:0,100',
            'discount' => $isPost ? 'required|numeric|between:0,100' : 'numeric|between:0,100',
            'inventory' => $isPost ? 'required|integer' : 'integer',
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
