<?php namespace App\Http\Requests;
use App\Abstracts\EntityValidator;
use App\Interfaces\ValidationInterface;
use Illuminate\Validation\Factory;

class CarValidator extends EntityValidator implements ValidationInterface
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
          'description_ar' => 'nullable' ,
          'description_en' => 'nullable' ,
          'image' => 'nullable' ,
          'available_from' => 'nullable' ,
          'available_to' => 'nullable' ,
          'store_id' => 'required' ,
          'brand_id' => 'required' ,
          'model_id' => 'required' ,
          'prices' => 'required' ,
          'status' => 'nullable' ,
          'color' => 'nullable' ,
          'type' => 'nullable' ,
          'year' => 'nullable' ,
          'tags' => 'nullable' ,
      ];

        $this->messages = [
      'title_ar.required' => 'Title Ar is required!' ,
        'title_en.required' => 'Title En is required!' ,
        'store_id.required' => 'Store Id is required!' ,
        'brand_id.required' => 'Brand Id is required!' ,
        'brand_id.required' => 'Brand Id is required!' ,
        'prices.required' => 'Prices is required!' ,
        ];
    }

}
