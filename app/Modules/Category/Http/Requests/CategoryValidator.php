<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;

class CategoryValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    protected $rules = [
        'name_ar' => 'required' , 
        'name_en' => 'required' , 
        'status' => 'nullable' , 
        'parent_id' => 'nullable' , 
        'image' => 'nullable' , 
      ];
    
    /**
     * Messages for creating a new Object
     *
     * @var array
     */
    public function messages(){
        return [
            'name_ar.required' => 'Name Ar is required!' , 
            'name_en.required' => 'Name En is required!' , 
            'status.required' => 'Status is required!' , 
        ];
    }
    
}
