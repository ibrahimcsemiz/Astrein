<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $password = Str::random(8);

        $response = DB::transaction(function() use ($request, $password) {
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

        if ($response) {
            return redirect()->back()->notify('success', 'Success', 'The operation was successful. <br><b>Password:</b> ' . $password);
        } else {
            return redirect()->back()->notify('error', 'Error', 'An error occurred during the operation.');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $user->load(['contact', 'personal']);

        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $response = DB::transaction(function() use ($user, $request) {

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

        if ($response) {
            return redirect()->back()->notify('success', 'Success', 'The operation was successful.');
        } else {
            return redirect()->back()->notify('error', 'Error', 'An error occurred during the operation.');
        }
    }

    public function destroy(User $user)
    {
        $deleteUser = $user->delete();

        if ($deleteUser) {
            return redirect()->route('users')->notify('success', 'Success', 'The operation was successful.');
        } else {
            return redirect()->back()->notify('error', 'Error', 'An error occurred during the operation.');
        }
    }
}
