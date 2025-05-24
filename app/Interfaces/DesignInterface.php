<?php

namespace App\Interfaces;

interface DesignInterface
{
    /**
     * @param array $input
     * @return self
     */
    public function toggleData() :array;
    
    /**
     * @param array $input
     * @return self
     */
    public function searchData() :array;

     /**
     * @return array
     */
    public function tableData();

    /**
     * @return boolean
     */
    public function addData();

    /**
     * @return array
     */
    public function editData();

    /**
     * @return array
     */
    public function getSpecificData($types=[]);

    /**
     * @return array
     */
    public function mainData();

}
