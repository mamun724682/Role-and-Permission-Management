<?php

namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.pages.users.create', compact('roles'));
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
    		'name' => 'required|unique:users'
    	],[
    		'name.required' => 'Please give a user name!'
    	]);

        $user = Role::create(['name' => $request->name]);
        $permissions = $request->permissions;

        if (!empty($permissions)) {
        	$user->syncPermissions($permissions);
        }

        session()->flash('success', 'Role has been created!');
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
    	$user = User::findById($id);

        $roles = Role::all();
        return view('backend.pages.users.edit', compact('roles', 'user'));
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
    		'name' => 'required|unique:users,name,' . $id
    	],[
    		'name.required' => 'Please give a user name!'
    	]);

        $user = User::findById($id);
        $permissions = $request->permissions;

        if (!empty($permissions)) {
        	$role->name = $request->name;
        	$role->save();
        	$role->syncPermissions($permissions);
        }

        session()->flash('success', 'Role has been updated!');
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
        $user = User::findById($id);
        if (!is_null($user)) {
        	$user->delete();
        }

        session()->flash('success', 'User has been Deleted!');
        return back();
    }
}
