<?php

namespace ApiVue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => 'required',
            'user_id' => 'required',
            'product_id' => 'required'
        ];
    }
}
