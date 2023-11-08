<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    use UploadImageTrait;

    public function getAll()
    {
        $users = User::paginate(15);
        return $users;
    }
    public function getOne($id)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        // $user = $user->translate();
        return $user;
    }
    public function createOne($request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,

        ]);
        $user->update([
            'picture' => $this->uploadImage($request->picture, 'users', $user->id . '_' . $user->name),
        ]);

        return $user;

    }
    public function updateOne($id, $request)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        if ($request->hasFile('picture')) {
            $this->deletePhoto($user->picture);
            $user->update([
                'picture' => $this->uploadImage($request->picture, 'users', $user->id . '_' . $user->name),
            ]);
        }

        return $user;
    }
    public function deleteOne($id)
    {
        $user = User::find($id);
        $this->deletePhoto($user->picture);
        $user->delete();
    }
    public function deleteAll()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->delete();
        }
    }

}
