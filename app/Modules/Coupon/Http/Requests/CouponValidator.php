<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;
use Illuminate\Validation\Factory;

class CouponValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    
    public function __construct(Factory $validator)
    {
        parent::__construct($validator);
        $this->rules = [
         'code' => 'required' , 
        'discount_type' => 'required' , 
        'discount_value' => 'required' , 
        'valid_until' => 'required' , 
        'status' => 'nullable' , 
        'valid_type' => 'nullable' , 
        'store_id' => 'required|exists:stores,id' , 
      ];

        $this->messages = [
      'code.required' => 'Code is required!' , 
        'discount_type.required' => 'Discount Type is required!' , 
        'discount_value.required' => 'Discount Value is required!' , 
        'valid_until.required' => 'Valid Until is required!' , 
        'store_id.required' => 'Store is required!' , 
        ];
    }
    
}
