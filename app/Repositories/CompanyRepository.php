<?php

namespace App\Repositories;

use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;
use App\Traits\UploadImageTrait;

class CompanyRepository implements CompanyRepositoryInterface
{
    use UploadImageTrait;

    public function getAll()
    {
        $companies = Company::paginate(15);
        return $companies;
    }
    public function getOne($id)
    {
        $company = company::find($id);
        return $company;
    }
    public function createOne($request)
    {
        $company = company::create($request->all());
    }
    public function updateOne($id, $request)
    {
        $company = company::find($id);
        $company->update($request->all());

        return $company;
    }
    public function deleteOne($id)
    {
        $company = company::find($id);
        $company->delete();
    }
    public function deleteAll()
    {
        $companies = company::all();
        foreach ($companies as $company) {
            $company->delete();
        }
    }

}
