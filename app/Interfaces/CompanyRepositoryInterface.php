<?php

namespace App\Interfaces;

use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;

interface CompanyRepositoryInterface
{
    public function getAll();
    public function getOne($id);
    public function deleteOne($id);
    public function deleteAll();
    public function createOne(StoreCompanyRequest $data);
    public function updateOne($id, UpdateCompanyRequest $data);
}
