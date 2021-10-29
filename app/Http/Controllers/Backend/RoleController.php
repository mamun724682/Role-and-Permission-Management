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
        $roles = Role::all();
        return view('backend.role.index', compact('roles'));
    }

    public function create()
    {
        $permissionGroups = Permission::get()->groupby('group_name');
        return view('backend.role.create', compact('permissionGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required', 'max:100', 'unique:roles,name'],
            'permissions' => ['required', 'array']
        ]);

        $role = Role::create(['name' => $request->role]);
        if (!empty($request->permissions)){
            $role->syncPermissions($request->permissions);
        }

        $notification = array(
            'message' => 'Role added!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissionGroups = Permission::get()->groupby('group_name');
        return view('backend.role.edit', compact('permissionGroups', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role' => ['required', 'max:100', 'unique:roles,name,'.$role->id],
            'permissions' => ['required', 'array']
        ]);

        if (!empty($request->permissions)){
            $role->syncPermissions($request->permissions);
        }

        $notification = array(
            'message' => 'Role updated!',
            'alert-type' => 'success'
        );

        return  back()->with($notification);
    }

    public function destroy($id)
    {
        //
    }
}
