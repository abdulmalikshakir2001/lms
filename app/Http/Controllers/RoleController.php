<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller
{
    
//     public static function middleware(): array
//     {
//       return [
//         new Middleware('permission:view roles', only:['index']),
//         new Middleware('permission:edit roles', only:['edit']),
//         new Middleware('permission:add roles', only:['create']),
//         new Middleware('permission:delete roles', only:['destroy'])
//     ];
// }




    public function index() {
      
      $roles = Role::orderBy('id','desc')->get(); 
      $permissions = Permission::orderBy('id','desc')->get();
      return view('roles.index',compact('roles','permissions'));

    }
    public function create() {
      
      $permission = Permission::orderBy('name','desc')->get();
      return view('roles/create',['permissions' => $permission]);

    }
    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[ 
            'name' => 'required|unique:roles'
        ]);

        if ($validator->passes()) {

            $role = Role::create(['name'=>$request->name]);
            if (!empty($request->permissions)) {
                foreach ($request->permissions as  $permission) {
                   $role->givePermissionTo($permission);
              }
            }


            return redirect()->route('roles.index')->with('success','Role Added successfully');
        }
        else {
            return redirect()->route('roles.index')->withInput()->withErrors($validator);
        }
    }
    public function edit($id) {
        $editRole = Role::findOrFail($id);
        $hasPermissions = $editRole->permissions->pluck('name');
        $permissions = Permission::all();
    
        return view('roles.edit', [
            'editRole' => $editRole,
            'hasPermission' => $hasPermissions,
            'permissions' => $permissions
        ]);
    }
    
    public function update(Request $request, $id) {
        $role = Role::findOrFail($id);
    
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id
        ]);
    
        if ($validator->passes()) {
            // Update role name
            $role->name = $request->name;
    
            // Sync permissions
            if (!empty($request->permissions)) {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]); // Remove all permissions if none selected
            }
    
            // Save changes
            $role->save();
    
            // Redirect to the roles index with success message
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        } else {
            // Redirect back to the edit form with errors and input data
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
    
    public function destroy(Request $request) {
        $id = $request->id;
        $role = Role::find($id);

       
        if ($role == null) {
         
            return redirect()->route('roles.index')->with('error', 'Role Not found');
            
         }
  
         $role->delete();
         return redirect()->route('roles.index')->with('success', 'Role deleted successfully');

        

    }

}


