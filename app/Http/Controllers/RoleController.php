<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class RoleController extends Controller implements HasMiddleware
 {
    public static function  middleware(): array
    {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:edit roles', only: ['edit']),
            new Middleware('permission:create roles', only: ['create']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }

    // This method will show role page
    public function index()
    {

        $roles = Role::orderBy('name', 'ASC')->paginate(10);
        return view('roles.index', [
            'roles' => $roles
        ]);
    }
    // This method will show create role page
    public function create()
    {
        $permissions = Permission::orderBy('created_at', 'asc')->get();
        return view('roles.create', ['role' => null, 'hasPermissions' => null, 'permissions' => $permissions]);
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
                    $role->givePermissionTo($permission);
                }
            }
            return redirect()->route('role.index')->with('success', 'role add successfully.');
        } else {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }
    //    This method will insert a role in DB
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('created_at', 'asc')->get();
        return view('roles.create', ['role' => $role, 'hasPermissions' => $hasPermissions, 'permissions' => $permissions]);
    }
    // This method will update a role
    public function  update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'unique:roles,name,' . $id],
        ]);
        $role = Role::findOrFail($id);
        if ($validate->passes()) {
            $role->name = $request->name;
            $role->save();
            if (!empty($request->permissions)) {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }
            return redirect()->route('role.index')->with('success', 'role updated successfully.');
        } else {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }

    // This method will delete a role
    public function destroy($id)
    {
        // dd($id);
        try {
            $role = Role::findOrFail($id); // Ensure the role exists
            $role->delete(); // Perform deletion
            session()->flash('success', 'Role deleted successfully.');
            return redirect()->route('role.index')->with('success', 'role deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('role.index')->with('error', 'Failed to delete role.');
        }
    }
}
