<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $password = Str::random(8);

        $response = DB::transaction(function() use ($request, $password) {
            $insertUser = User::create([
                'name' => Str::title($request->input('name')),
                'email' => $request->input('email'),
                'function' => $request->input('function'),
                'password' => Hash::make($password)
            ]);

            // Creating Contact Information

            $insertContactInformation = $insertUser->contact()->create([
                'telephone' => $request->input('telephone'),
                'city' => $request->input('city'),
                'address' => $request->input('address')
            ]);

            // Creating Personal Information

            $insertPersonalInformation = $insertUser->personal()->create([
                'birth_date' => $request->input('birth_date')
            ]);

            if ($insertUser && $insertContactInformation && $insertPersonalInformation) {
                return true;
            } else {
                return false;
            }
        });

        if ($response) {
            return redirect()->back()->with('status', 'success')->with('message', 'The operation was successful. <br><b>Password:</b> ' . $password);
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $user = User::exists($id);

        if (!$user) {
            return redirect(url('users'))->with('status', 'error')->with('message', 'User not found.');
        }

        return view('users.edit', [
            'data' => $user->with('contact')->with('personal')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::exists($id);

        if (!$user) {
            return redirect(url('users'))->with('status', 'error')->with('message', 'User not found.');
        }

        $response = DB::transaction(function() use ($user, $request) {

            $updateUser = $user->update([
                'name' => Str::title($request->input('name')),
                'email' => $request->input('email'),
                'function' => $request->input('function')
            ]);

            // Updating Contact Information

            $updateContactInformation = $user->contact()->update([
                'telephone' => $request->input('telephone'),
                'city' => $request->input('city'),
                'address' => $request->input('address')
            ]);

            // Updating Personal Information

            $updatePersonalInformation = $user->personal()->update([
                'birth_date' => $request->input('birth_date')
            ]);

            if ($updateUser && $updateContactInformation && $updatePersonalInformation) {
                return true;
            } else {
                return false;
            }
        });

        if ($response) {
            return redirect()->back()->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = User::exists($id);

        if (!$user) {
            return redirect(url('users'))->with('status', 'error')->with('message', 'User not found.');
        }

        $deleteUser = $user->delete();

        if ($deleteUser) {
            return redirect(url('users'))->with('status', 'success')->with('message', 'The operation was successful.');
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'An error occurred during the operation.');
        }
    }
}
