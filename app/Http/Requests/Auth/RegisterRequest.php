<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username'       => 'required|min:2|unique:users',
            'email'          => 'required|email|unique:users',
            'wallet_address' => 'required|min:6|unique:users',
            'wallet_type'    => 'required|min:2'
        ];
    }
}
