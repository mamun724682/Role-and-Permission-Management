<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(!auth()->guard('admin')->user() || !auth()->guard('admin')->user()->can('role.view'), 403, 'You are not authorized to view role');

        $roles = Role::all();
        return view('backend.role.index', compact('roles'));
    }

    public function create()
    {
        abort_if(!auth()->guard('admin')->user() || !auth()->guard('admin')->user()->can('role.create'), 403, 'You are not authorized to create role');

        $permissionGroups = Permission::get()->groupby('group_name');
        return view('backend.role.create', compact('permissionGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required', 'max:100', 'unique:roles,name'],
            'permissions' => ['required', 'array']
        ]);

        $role = Role::create(['name' => $request->role, 'guard_name' => 'admin']);
        if (!empty($request->permissions)){
            $role->syncPermissions($request->permissions);
        }

        $notification = array(
            'message' => 'Role added!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }

    public function edit(Role $role)
    {
        abort_if(!auth()->guard('admin')->user() || !auth()->guard('admin')->user()->can('role.edit'), 403, 'You are not authorized to edit role');

        $permissionGroups = Permission::get()->groupby('group_name');
        return view('backend.role.edit', compact('permissionGroups', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role' => ['required', 'max:100', 'unique:roles,name,'.$role->id],
            'permissions' => ['required', 'array']
        ]);

        $role->name = $request->role;
        $role->guard_name = 'admin';
        $role->save();

        if (!empty($request->permissions)){
            $role->syncPermissions($request->permissions);
        }

        $notification = array(
            'message' => 'Role updated!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }

    public function destroy(Role $role)
    {
        abort_if(!auth()->guard('admin')->user() || !auth()->guard('admin')->user()->can('role.delete'), 403, 'You are not authorized to delete role');

        $role->delete();

        $notification = array(
            'message' => 'Role deleted!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }
}
