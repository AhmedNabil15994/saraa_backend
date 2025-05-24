<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;
use Illuminate\Validation\Factory;

class StoreValidator extends EntityValidator implements ValidationInterface
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
         'title_ar' => 'required' , 
          'title_en' => 'required' , 
          'seller_id' => 'required' , 
          'state_id' => 'required' , 
          'status' => 'nullable' , 
          'image' => 'nullable' , 
          'address_ar' => 'nullable' , 
          'address_en' => 'nullable' , 
          'contact_info' => 'nullable' , 
          'description_ar' => 'nullable' , 
          'description_en' => 'nullable' , 
          'off_days' => 'nullable' , 
          'work_from' => 'nullable' , 
          'work_to' => 'nullable' , 
          'lat' => 'nullable' , 
          'lng' => 'nullable' , 
          'emp_ids' => 'nullable',
      ];

        $this->messages = [
      'title_ar.required' => 'Title Ar is required!' , 
        'title_en.required' => 'Title En is required!' , 
        'seller_id.required' => 'Seller Id is required!' , 
        'state_id.required' => 'State Id is required!' , 
        ];
    }
    
}
