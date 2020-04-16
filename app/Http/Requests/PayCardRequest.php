<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return session('userId', false) && (session('cartCount', 0) > 0);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cvc' => 'required',
            'expiry' => 'required',
            'name' => 'required',
            'number' => 'required'
        ];
    }
}
