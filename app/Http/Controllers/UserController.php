<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;

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

    public function store(UserRequest $request, UserService $userService)
    {
        $insertUser = $userService->store($request);

        if ($insertUser) {
            return redirect()->back()->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
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

    public function update(UserRequest $request, User $user, UserService $userService)
    {
        $updateUser = $userService->update($request, $user);

        if ($updateUser) {
            return redirect()->back()->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }

    public function destroy(User $user)
    {
        $deleteUser = $user->delete();

        if ($deleteUser) {
            return redirect()->route('users')->notify('success', __('language.success'), __('language.success_message'));
        } else {
            return redirect()->back()->notify('error', __('language.error'), __('language.error_message'));
        }
    }
}
