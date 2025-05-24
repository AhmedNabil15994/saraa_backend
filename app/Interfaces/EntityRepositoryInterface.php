<?php

namespace App\Interfaces;

interface EntityRepositoryInterface {
    public function getAll($request);
    public function getById($id);
    public function create($request);
    public function update($request,$id);
    public function delete($model);
}
