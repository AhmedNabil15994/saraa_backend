<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;
use Illuminate\Validation\Factory;

class ClientUpdateValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    public function __construct(Factory $validator)
    {
        parent::__construct($validator);
        $this->rules =[
            'email' => "required|unique:users,email" ,
            'name' => 'required' ,
            'role_id' => 'required' ,
            'password' => 'nullable|min:6|same:password_confirmation',
            'password_confirmation' => 'nullable|min:6',
            'mobile' => 'required|unique:users,mobile' ,
            'extra_permissions' => 'nullable' ,
            'status' => 'integer|nullable' ,
            'image' => 'nullable' ,
            'is_verified' => 'nullable' ,
            'calling_code' => 'nullable' ,
        ];

        $this->messages = [
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
