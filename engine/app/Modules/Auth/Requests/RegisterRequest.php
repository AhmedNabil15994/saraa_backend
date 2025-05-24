<?php namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'mobile' => 'required',
            'calling_code' => 'required',
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

    public function messages(){
        return [
            'name.required' => trans('main.name_required'),
            'email.required' => trans('main.email_required'),
            'email.email' => trans('main.email_email'),
            'email.unique' => trans('main.email_exists'),
            'password.required' => trans('main.password_required'),
            'password.confirmed' => trans('main.password_confirmed'),
            'password.min' => trans('main.password_min'),
            'password_confirmation.required' => trans('main.password_confirmed'),
            'mobile.required' => trans('main.mobile_required'),
            'calling_code.required' => trans('main.calling_code_required'),
        ];
    }

    /**
    * [failedValidation [Overriding the event validator for custom error response]]
    * @param  Validator $validator [description]
    * @return [object][object of various validation errors]
    */

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(\TraitsFunc::invalidData($validator->errors()));
    }

}
