<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'password', 'confirmed']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (!empty($request->roles)){
            $user->syncRoles($request->roles);
        }

        $notification = array(
            'message' => 'User added!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('backend.user.edit', compact('roles', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'password', 'confirmed']
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if (!empty($request->roles)){
            $user->syncRoles($request->roles);
        }

        $notification = array(
            'message' => 'User updated!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }

    public function destroy(User $user)
    {
        $user->delete();

        $notification = array(
            'message' => 'User deleted!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }
}
