<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminChangePasswordRequest;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\Admin\AdminRegisterRequest;
use App\Http\Requests\Admin\AdminUpdateProfileDetailsRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use GeneralTrait;
    public function create(AdminRegisterRequest $request)
    {
        try {

            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            $admin->assignRole('Admin');
            $token = $admin->createToken("API TOKEN")->plainTextToken;
            $data = [
                'admin' => new AdminResource($admin),
                'token' => $token,
            ];
            return $this->returnData($data, 'Admin Created Successfully');

        } catch (\Throwable $th) {
            return $this->returnError($th->getMessage());
        }
    }

    /**
     * Login The Admin
     * @param Request $request
     * @return User
     */
    public function login(AdminLoginRequest $request)
    {
        try {
            $admin = Admin::where('email', $request->email)->first();
            if (!Hash::check($request->password, $admin->password)) {
                return $this->returnError('Email & Password does not match with our record.');
            }

            $token = $admin->createToken("API TOKEN")->plainTextToken;
            $data = [
                'admin' => new AdminResource($admin),
                'token' => $token,
            ];
            return $this->returnData($data, 'Admin Logged In Successfully');

        } catch (\Throwable $th) {

            return $this->returnError($th->getMessage());
        }
    }
    public function updateProfileDetails(AdminUpdateProfileDetailsRequest $request, $id)
    {
        try {
            $admin = Admin::find($id);
            if (!$admin) {
                return $this->returnError('Admin Does Not Exist');
            }
            $admin->update($request->all());
            $data = new AdminResource($admin);
            return $this->returnData($data, 'Admin Is Updated Successfully');
        } catch (\Throwable $th) {
            return $this->returnError($th->getMessage());
        }

    }
    public function showProfileDetails($id)
    {
        try {
            $admin = Admin::find($id);
            if (!$admin) {
                return $this->returnError('Admin Does Not Exist');
            }
            $data = new AdminResource($admin);
            return $this->returnData($data, 'Admin Is Retrieved Successfully');
        } catch (\Throwable $th) {
            return $this->returnError($th->getMessage());
        }

    }
    public function changePassword(AdminChangePasswordRequest $request, $id)
    {
        try {
            $admin = Admin::find($id);
            if (!$admin) {
                return $this->returnError('Admin Does Not Exist');
            }
            if (!Hash::check($request->currentPassword, $admin->password)) {
                return $this->returnError('Current Password is wrong');
            }
            $admin->update([
                'password' => Hash::make($request->newPassword),
            ]);
            //logout after update password
            auth()->user()->tokens()->delete();
            return $this->returnSuccessMessage('Password Is Changed And Logged out successfully');
        } catch (Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }
    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->returnSuccessMessage('Logged out successfully');

        } catch (Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }
}
