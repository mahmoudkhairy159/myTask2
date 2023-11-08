<?php

namespace App\Http\Controllers\User\Auth;

use App\Events\PasswordChanged;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserChangePasswordRequest;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Requests\User\UserUpdateProfileDetailsRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    use GeneralTrait;
    public function create(UserRegisterRequest $request)
    {
        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            $user->assignRole('Customer');
            $token = $user->createToken("API TOKEN")->plainTextToken;
            $user = new UserResource($user);
            $data = [
                'user' => $user,
                'token' => $token,
            ];
            return $this->returnData($data, 'User Created Successfully');

        } catch (\Throwable $th) {
            return $this->returnError($th->getMessage());
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function login(UserLoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->returnError('Email & Password does not match with our record.');
            }

            // Revoke existing tokens for this user
            $user->tokens->each(fn($token) => $token->delete());

            $token = $user->createToken("API TOKEN")->plainTextToken;
            $data = [
                'user' => new UserResource($user),
                'token' => $token,
            ];
            return $this->returnData($data, 'User Logged In Successfully');
        } catch (\Throwable $th) {
            return $this->returnError($th->getMessage());
        }
    }

    public function updateProfileDetails(UserUpdateProfileDetailsRequest $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->returnError('User Does Not Exist');
            }
            $user->update($request->all());
            $data = new UserResource($user);
            return $this->returnData($data, 'User Is Updated Successfully');

        } catch (\Throwable $th) {

            return $this->returnError($th->getMessage());
        }

    }

    public function changePassword(UserChangePasswordRequest $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->returnError('User Does Not Exist');
            }
            if (!Hash::check($request->currentPassword, $user->password)) {
                return $this->returnError('Current Password is wrong');
            }
            $user->update([
                'password' => Hash::make($request->newPassword),
            ]);
            event(new PasswordChanged($user));

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
        } catch (\Throwable $th) {

            return $this->returnError($th->getMessage());
        }
    }
}
