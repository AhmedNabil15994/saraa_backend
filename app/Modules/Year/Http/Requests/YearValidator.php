<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;
use Illuminate\Validation\Factory;

class YearValidator extends EntityValidator implements ValidationInterface
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
         'title' => 'required' , 
      'status' => 'nullable' , 
      ];

        $this->messages = [
      'title.required' => 'Title is required!' , 
        ];
    }
    
}
