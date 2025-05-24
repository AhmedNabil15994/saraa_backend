<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email',
            'password'  => 'required|min:6',
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
        $v = [
            'email.required'      =>   trans('Auth::login.validations.email.required'),
            'email.email'         =>   trans('Auth::login.validations.email.email'),
            'password.required'   =>   trans('Auth::login.validations.password.required'),
            'password.min'        =>   trans('Auth::login.validations.password.min'),
        ];

        return $v;
    }
}
