<?php

namespace App\Abstracts;

abstract class AbstractValidator
{
    /**
     * Validator
     *
     * @var object
     */
    protected $validator;

    /**
     * Data to be validated
     *
     * @var array
    */

    protected $id;

    /**
     * Data to be validated
     *
     * @var array
     */
    protected $data = array();

    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = array();

    /**
     * Validation Messages
     *
     * @var array
     */
    protected $messages = array();

    /**
     * Validation errors
     *
     * @var array
     */
    protected $errors = array();

    /**
     * Set data to validate
     *
     * @param array $data
     * @return self
     */
    public function with(array $data,int $id=0)
    {
        $this->data = $data;
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Return errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Pass the data and the rules to the validator
     *
     * @return boolean
     */
    abstract function passes();

    public function id()
    {
        return $this->id;
    }

}
