<?php namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateValidator extends FormRequest
{
    
    public function rules(){
        return [
            'email' => "required|unique:users,email,".$this->id ,
            'name' => 'required' ,
            'role_id' => 'required' ,
            'password' => 'nullable|min:6|same:password_confirmation',
            'password_confirmation' => 'nullable|min:6',
            'mobile' => 'required|unique:users,mobile,'.$this->id ,
            'extra_permissions' => 'nullable' ,
            'status' => 'integer|nullable' ,
            'image' => 'nullable' ,
            'is_verified' => 'nullable' ,
            'calling_code' => 'nullable' ,
        ];
    }

    public function authorize(){
        return true;
    }

    public function messages(){
        return [
            'email.required' => trans('User::user.form.validations.email_required') ,
            'email.email' => trans('User::user.form.validations.email_email') ,
            'name.required' => trans('User::user.form.validations.name_required') ,
            'mobile.required' => trans('User::user.form.validations.mobile_required') ,
            'mobile.unique' => trans('User::user.form.validations.mobile_unique') ,
            'role_id.required' => trans('User::user.form.validations.role_id_unique') ,
            'password.confirmed' => trans('User::user.form.validations.password_confirmed') ,
            'password.min' => trans('User::user.form.validations.password_min') ,
        ];
    }
}
