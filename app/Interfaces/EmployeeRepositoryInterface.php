<?php

namespace App\Interfaces;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;

interface EmployeeRepositoryInterface
{
    public function getAll();
    public function getOne($id);
    public function deleteOne($id);
    public function deleteAll();
    public function createOne(StoreEmployeeRequest $data);
    public function updateOne($id, UpdateEmployeeRequest $data);
}
