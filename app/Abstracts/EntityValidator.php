<?php

namespace App\Abstracts;
use Illuminate\Validation\Factory;
use App\Abstracts\AbstractValidator;
use App\Interfaces\ValidationInterface;
abstract class EntityValidator extends AbstractValidator
{

    /**
     * Validator
     *
     * @var Illuminate\Validation\Factory
     */
    protected $validator;

    /**
     * Construct
     *
     * @param Illuminate\Validation\Factory $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Pass the data and the rules to the validator
     *
     * @return boolean
     */
    public function passes()
    {
        if($this->id){
            $rules = [];
            foreach($this->rules as $key => $rule){
                if(str_contains($rule, 'unique')){
                    $rule.=",".$this->id;
                }
                $rules[$key] = $rule;
            }
            $this->rules = $rules;
        }

        $validator = $this->validator->make($this->data, $this->rules,$this->messages);

        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }
        return $validator;
    }
}
