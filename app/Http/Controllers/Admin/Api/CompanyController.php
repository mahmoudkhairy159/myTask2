<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Resources\Company\CompanyCollection;
use App\Http\Resources\Company\CompanyResource;
use App\Interfaces\CompanyRepositoryInterface;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use GeneralTrait;
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $companies = $this->companyRepository->getAll();
            $data = new CompanyCollection($companies);
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
    public function store(StoreCompanyRequest $request)
    {
        try {
            $company = $this->companyRepository->createOne($request);
            $data = new CompanyResource($company);
            return $this->returnData($data, 'company Is Created Successfully');

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
        $company = $this->companyRepository->getOne($id);
        if (!$company) {
            return $this->returnError('company does not exist');
        }
        $data = new CompanyResource($company);
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
    public function update(UpdateCompanyRequest $request, $id)
    {
        try {
            $company = $this->companyRepository->getOne($id);
            if (!$company) {
                return $this->returnError('company does not exist');
            }

            $company = $this->companyRepository->updateOne($id, $request);
            $data = new CompanyResource($company);
            return $this->returnData($data, 'company Is Updated Successfully');

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
            $company = $this->companyRepository->getOne($id);
            if (!$company) {
                return $this->returnError('company does not exist');
            }
            $this->companyRepository->deleteOne($id);
            return $this->returnSuccessMessage('company Is Deleted Successfully.');
        } catch (Exception $e) {
            return $this->returnError($e->getMessage());
        }

    }
}
