<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Log;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    use UploadImageTrait;

    public function getAll()
    {
        $employees = Employee::paginate(15);
        return $employees;
    }
    public function getOne($id)
    {
        $employee = employee::find($id);
        return $employee;
    }
    public function createOne($request)
    {
        $employee = employee::create($request->all());
        Log::info('Employee Created successfully', ['user' => $employee]);

    }
    public function updateOne($id, $request)
    {
        $employee = employee::find($id);
        $employee->update($request->all());
        Log::info('Employee updated successfully', ['user' => $employee]);

        return $employee;
    }
    public function deleteOne($id)
    {
        $employee = employee::find($id);
        $employee->delete();
    }
    public function deleteAll()
    {
        $employees = employee::all();
        foreach ($employees as $employee) {
            $employee->delete();
        }
    }

}
