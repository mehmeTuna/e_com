<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'fullName' => 'required|min:3|max:255',
            'username' => 'required|unique:users,email',
            'password' => 'required|min:4|max:25',
            'address' => 'required|min:3|max:100',
            'phone' => 'required|min:6|max:20',
        ];
    }
}
