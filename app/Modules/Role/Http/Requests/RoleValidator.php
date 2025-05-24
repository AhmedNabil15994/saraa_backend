<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;

class RoleValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    protected $rules = [
        'name_ar' => 'required' ,
        'name_en' => 'required',
        'status' => 'integer|nullable' , 
        'permissions' => 'nullable'
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
        ];
    }
    
}
