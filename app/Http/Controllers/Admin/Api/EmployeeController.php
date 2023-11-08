<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Resources\Employee\employeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Interfaces\UserRepositoryInterface;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use GeneralTrait;
    private $employeeRepository;

    public function __construct(UserRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $employees = $this->employeeRepository->getAll();
            $data = new employeeCollection($employees);
            return $this->returnData($data, 'Data is Returned Successfully');
        } catch (Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = $this->employeeRepository->createOne($request);
            $data = new EmployeeResource($employee);
            return $this->returnData($data, 'Employee Is Created Successfully');

        } catch (Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {try {
        $employee = $this->employeeRepository->getOne($id);
        if (!$employee) {
            return $this->returnError('employee does not exist');
        }
        $data = new EmployeeResource($employee);
        return $this->returnData($data, 'Data is Returned Successfully');
    } catch (Exception $e) {
        return $this->returnError($e->getMessage());
    }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        try {
            $employee = $this->employeeRepository->getOne($id);
            if (!$employee) {
                return $this->returnError('employee does not exist');
            }

            $employee = $this->employeeRepository->updateOne($id, $request);

            $data = new EmployeeResource($employee);
            return $this->returnData($data, 'employee Is Updated Successfully');

        } catch (Exception $e) {
            return $this->returnError($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $employee = $this->employeeRepository->getOne($id);
            if (!$employee) {
                return $this->returnError('Employee does not exist');
            }
            $this->employeeRepository->deleteOne($id);
            return $this->returnSuccessMessage('Employee Is Deleted Successfully.');
        } catch (Exception $e) {
            return $this->returnError($e->getMessage());
        }

    }
}
