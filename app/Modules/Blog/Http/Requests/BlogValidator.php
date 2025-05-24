<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;

class BlogValidator extends EntityValidator implements ValidationInterface
{
    /**
     * Validation for creating a new Object
     *
     * @var array
     */
    protected $rules = [
          'title_ar' => 'required' , 
          'title_en' => 'required' , 
          'date' => 'required' , 
          'status' => 'nullable' , 
          'image' => 'nullable' , 
          'views' => 'nullable' , 
          'description_ar' => 'nullable' , 
          'description_en' => 'nullable' , 
          'category_id' => 'nullable' , 
      ];
    
    /**
     * Messages for creating a new Object
     *
     * @var array
     */
    public function messages(){
        return [
      'title_ar.required' => 'Title Ar is required!' , 
        'title_en.required' => 'Title En is required!' , 
        'date.required' => 'Date is required!' , 
        ];
    }
    
}
