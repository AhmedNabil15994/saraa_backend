<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;

class ContactUsValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    protected $rules = [
         'name' => 'required' , 
      'email' => 'required' , 
      'phone' => 'required' , 
      'message' => 'required' , 
      'status' => 'required' , 
      ];
    
    /**
     * Messages for creating a new Object
     *
     * @var array
     */
    public function messages(){
        return [
      'name.required' => 'Name is required!' , 
        'email.required' => 'Email is required!' , 
        'phone.required' => 'Phone is required!' , 
        'message.required' => 'Message is required!' , 
        'status.required' => 'Status is required!' , 
        ];
    }
    
}
