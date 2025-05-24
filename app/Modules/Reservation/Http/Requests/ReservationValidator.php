<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;
use Illuminate\Validation\Factory;

class ReservationValidator extends EntityValidator implements ValidationInterface
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
         'store_id' => 'required' , 
          'car_id' => 'required' , 
          'client_id' => 'required' , 
          'reserve_from' => 'required' , 
          'reserve_to' => 'required' , 
          'price' => 'required' , 
          'status' => 'nullable' , 
          'notes' => 'nullable' , 
      ];

        $this->messages = [
      'store_id.required' => 'Store Id is required!' , 
        'car_id.required' => 'Car Id is required!' , 
        'client_id.required' => 'Client Id is required!' , 
        'reserve_from.required' => 'Reserve From is required!' , 
        'reserve_to.required' => 'Reserve To is required!' , 
        'price.required' => 'Price is required!' , 
        ];
    }
    
}
