<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;
use Illuminate\Validation\Factory;

class CarTypeValidator extends EntityValidator implements ValidationInterface
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
      'status' => 'nullable' , 
      ];

        $this->messages = [
      'title_ar.required' => 'Title Ar is required!' , 
        'title_en.required' => 'Title En is required!' , 
        ];
    }
    
}
