<?php

namespace App\Interfaces;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

interface UserRepositoryInterface
{
    public function getAll();
    public function getOne($userId);
    public function deleteOne($userId);
    public function deleteAll();
    public function createOne(UserStoreRequest $data);
    public function updateOne($userId, UserUpdateRequest $data);
}
