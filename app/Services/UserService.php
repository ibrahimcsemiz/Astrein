<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function store($request)
    {
        $password = Str::random(8);

        return DB::transaction(function() use ($request, $password) {
            $insertUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'function' => $request->function,
                'password' => Hash::make($password)
            ]);

            $insertContactInformation = $insertUser->contact()->create([
                'telephone' => $request->telephone,
                'city' => $request->city,
                'address' => $request->address
            ]);

            $insertPersonalInformation = $insertUser->personal()->create([
                'birth_date' => $request->birth_date
            ]);

            if ($insertUser && $insertContactInformation && $insertPersonalInformation) {
                return true;
            } else {
                return false;
            }
        });
    }

    public function update($request, $user)
    {
        return DB::transaction(function() use ($user, $request) {
            $updateUser = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'function' => $request->function
            ]);

            $updateContactInformation = $user->contact()->update([
                'telephone' => $request->telephone,
                'city' => $request->city,
                'address' => $request->address
            ]);

            $updatePersonalInformation = $user->personal()->update([
                'birth_date' => $request->birth_date
            ]);

            if ($updateUser && $updateContactInformation && $updatePersonalInformation) {
                return true;
            } else {
                return false;
            }
        });
    }
}
