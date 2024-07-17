<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return Inertia::render(
            'Admin/User/Index',
            [
                'users' => $users,
            ]
        );
    }

    public function store(UserStoreRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function update(UserStoreRequest $request, User $user)
    {
        $user->update($request->validated());
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
