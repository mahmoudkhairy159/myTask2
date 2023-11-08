<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use GeneralTrait;
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = $this->userRepository->getAll();
            $data = new UserCollection($users);
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
    public function store(UserStoreRequest $request)
    {
        try {
            $user = $this->userRepository->createOne($request);
            $data = new UserResource($user);
            return $this->returnData($data, 'User Is Created Successfully');

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
        $user = $this->userRepository->getOne($id);
        if (!$user) {
            return $this->returnError('user does not exist');
        }
        $data = new UserResource($user);
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
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = $this->userRepository->getOne($id);
            if (!$user) {
                return $this->returnError('user does not exist');
            }

            $user = $this->userRepository->updateOne($id, $request);
            $data = new UserResource($user);
            return $this->returnData($data, 'user Is Updated Successfully');

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
            $user = $this->userRepository->getOne($id);
            if (!$user) {
                return $this->returnError('User does not exist');
            }
            $this->userRepository->deleteOne($id);
            return $this->returnSuccessMessage('User Is Deleted Successfully.');
        } catch (Exception $e) {
            return $this->returnError($e->getMessage());
        }

    }
}
