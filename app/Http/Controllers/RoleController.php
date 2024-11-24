<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // This method will show role page
    public function index()
    {
        $roles = Permission::orderBy('created_at', 'asc')->paginate(5);
        return view('roles.list', ['roles' => $roles]);
    }
    // This method will show create role page
    public function create()
    {
        $permissions = Permission::orderBy('created_at', 'asc')->paginate(5);
        return view('roles.create', ['role' => null, 'permissions' => $permissions]);
    }
    // This method will insert a role in DB
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'unique:roles,name'],

        ]);
        if ($validate->passes()) {
            $role =  Role::create(['name' =>  $request->name]);
            if (!empty($request->permissions)) {
                foreach ($request->permissions as $permission) {
                  $role -> givePermissionTo($permission);
              }
              }
            return redirect()->route('role.list')->with('success', 'role add successfully.');
        } else {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }
    //    This method will insert a role in DB
    public function edit($id)
    {
        $permissions = Permission::orderBy('created_at', 'asc')->paginate(5);
        $role = Permission::findORfail($id);
        return view('roles.create', ['role' => $role, 'permissions' => $permissions]);
    }
    // This method will update a role
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'unique:roles,name,' . $id],
        ]);
        $role = Permission::findOrFail($id);

        if ($validate->passes()) {
            $role->update(['name' => $request->input('name')]);

            return redirect()->route('role.list')->with('success', 'role updated successfully.');
        } else {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }

    // This method will delete a role
    public function destroy($id)
    {
        try {
            $role = Permission::findOrFail($id); // Ensure the role exists
            $role->delete(); // Perform deletion
            return redirect()->route('role.list')->with('success', 'role deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('role.list')->with('error', 'Failed to delete role.');
        }
    }
}
