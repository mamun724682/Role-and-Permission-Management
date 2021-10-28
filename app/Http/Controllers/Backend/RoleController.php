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
        $permissions = Permission::all();
        return view('backend.role.create', compact('permissions'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
