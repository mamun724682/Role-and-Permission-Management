<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public $admin;
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            $this->admin = auth()->guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        abort_if(!$this->admin || !$this->admin->can('admin.view'), 403);

        $admins = Admin::latest()->get();
        return view('backend.admin.index', compact('admins'));
    }

    public function create()
    {
        abort_if(!$this->admin || !$this->admin->can('admin.create'), 403);

        $roles = Role::all();
        return view('backend.admin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        abort_if(!$this->admin || !$this->admin->can('admin.create'), 403);

        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:admins'],
            'username' => ['required', 'unique:admins'],
            'password' => ['required', 'confirmed']
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        if (!empty($request->roles)){
            $admin->syncRoles($request->roles);
        }

        $notification = array(
            'message' => 'Admin added!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }

    public function edit(Admin $admin)
    {
        abort_if(!$this->admin || !$this->admin->can('admin.edit'), 403);

        $roles = Role::all();
        return view('backend.admin.edit', compact('roles', 'admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        abort_if(!$this->admin || !$this->admin->can('admin.edit'), 403);

        $request->validate([
            'name' => ['required', 'max:100'],
            'username' => ['required', 'unique:admins,username,'.$admin->id],
            'email' => ['required', 'email', 'unique:admins,email,'.$admin->id],
            'password' => ['nullable', 'password', 'confirmed']
        ]);

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        if ($request->password){
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        if (!empty($request->roles)){
            $admin->syncRoles($request->roles);
        }

        $notification = array(
            'message' => 'Admin updated!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }

    public function destroy(Admin $admin)
    {
        abort_if(!$this->admin || !$this->admin->can('admin.delete'), 403);

        $admin->delete();

        $notification = array(
            'message' => 'Admin deleted!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }
}
