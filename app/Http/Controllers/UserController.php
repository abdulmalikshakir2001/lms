<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('id','desc')->get();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required|min:5'

        ]);

        if ($validator->passes()) {

            // $role = Role::create(['name'=>$request->name]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();  
            if (!empty($request->roles)) {
                $user->syncRoles($request->roles);
            }else {
                $user->syncRoles([]);
            }

            return redirect()->route('users.index')->with('success','User Updated successfully');
        }
        else {
            return redirect()->route('users.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('id','desc')->get();
        $hasRoles = $user->roles->pluck('id');
        return view('users.edit',compact('user','roles','hasRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(),[ 
            'name' => 'required|min:2',
            'email' => 'required|unique:users,email,"'.$id.'"|min:3'
        ]);

        if ($validator->passes()) {

            // $role = Role::create(['name'=>$request->name]);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != null) {
                $user->password = $request->password;
            }
            $user->save();  
            if (!empty($request->roles)) {
                $user->syncRoles($request->roles);
            }else {
                $user->syncRoles([]);
            }


            return redirect()->route('users.index')->with('success','User Updated successfully');
        }
        else {
            return redirect()->route('users.edit')->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user == null) {

            return redirect()->route('users.index')->with('error','User Not Found');
            
        }else {
            $user->delete();
            return redirect()->route('users.index')->with('success','User deleted successfully');

        }
    }
}
