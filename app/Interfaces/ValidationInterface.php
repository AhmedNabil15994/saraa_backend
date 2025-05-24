<?php

namespace App\Interfaces;

interface ValidationInterface
{
    /**
     * @param array $input
     * @return self
     */
    public function with(array $input,int $id);

    /**
     * @return boolean
     */
    public function passes();

    /**
     * @return array
     */
    public function errors();

    public function id();
}
