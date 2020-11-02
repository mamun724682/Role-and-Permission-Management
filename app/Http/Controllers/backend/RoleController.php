<?php

namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('backend.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$permissions_groups = User::getPermissionsGroupName();
        $all_permissions = Permission::all();
        return view('backend.pages.roles.create', compact('all_permissions', 'permissions_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	// dd($request->permissions);
    	$request->validate([
    		'name' => 'required|unique:roles'
    	],[
    		'name.required' => 'Please give a role name!'
    	]);

        $role = Role::create(['name' => $request->name]);
        $permissions = $request->permissions;

        if (!empty($permissions)) {
        	$role->syncPermissions($permissions);
        }
        return back();
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
    	$role = Role::findById($id);

        $permissions_groups = User::getPermissionsGroupName();
        $all_permissions = Permission::all();
        return view('backend.pages.roles.edit', compact('all_permissions', 'permissions_groups', 'role'));
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
        $request->validate([
    		'name' => 'required'
    	],[
    		'name.required' => 'Please give a role name!'
    	]);

        $role = Role::findById($id);
        $permissions = $request->permissions;

        if (!empty($permissions)) {
        	$role->syncPermissions($permissions);
        }
        return back();
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
