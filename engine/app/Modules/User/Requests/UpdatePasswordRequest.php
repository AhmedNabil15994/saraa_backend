<?php namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
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
            'old_password.required' => trans('main.old_password_required'),
            'old_password.min' => trans('main.old_password_min'),
            'password.required' => trans('main.password_required'),
            'password.confirmed' => trans('main.password_confirmed'),
            'password.min' => trans('main.password_min'),
            'password_confirmation.required' => trans('main.password_confirmed'),
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
