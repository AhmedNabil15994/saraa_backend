<?php namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'reserve_from' => 'required',
            'reserve_to' => 'required',
            'coupon_code' => 'required',
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
            'car_id.required' => trans('main.car_required'),
            'car_id.exists' => trans('main.notFound'),
            'reserve_from.required' => trans('main.reserve_from_required'),
            'reserve_to.required' => trans('main.reserve_to_required'),
            'coupon_code.required' => trans('main.coupon_required'),
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
