<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Validator;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('id','desc')->get();
        return view('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {
           
            Permission::create(['name'=>$request->name]);
            return redirect()->route('permissions.index')->with('success','Permission Added successfully');
        }
        else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
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
    public function edit(string $id,Request $request)
    {
        $permissions = Permission::findOrFail($id);
        $showModal = $request->query('show_modal', false);
        return view('permissions.edit',['permission' => $permissions, 'showModal' => $showModal]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request);
        $id = $request->permission_id;
        $permissions = Permission::findOrFail($id);

        $validator = Validator::make($request->all(),[ 
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {
           
            $permissions->name = $request->name;
            $permissions->save();
            return redirect()->route('permissions.index')->with('success','Permission Updated successfully');
        }
        else {
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        
        $id = $request->id;
        $permission = Permission::find($id);
        if ($permission == null) {
           
            return redirect()->route('roles.index')->with('error','Permission Not Found');
        }
        else {
            $permission->delete();
            return redirect()->route('permissions.index')->with('success','Permission Deleted Successfully');
        }
 
     }
}
