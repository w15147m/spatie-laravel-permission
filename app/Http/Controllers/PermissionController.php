<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use function PHPUnit\Framework\returnSelf;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit']),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }
    // This method will show permissions page
    public function index() {
        $permissions = Permission::orderBy('created_at', 'asc')->paginate(20);
        return view('permission.index', ['permissions' => $permissions]);
    }
    // This method will show create permission page
    public function create() {
        return view('permission.create', ['permission' => null]);
    }
    // This method will insert a permission in DB
    public function store() {
        $validate = Validator::make(request()->all(), [
          'name' => ['required', 'string', 'min:3', 'unique:permissions,name'],

        ]);
        if ($validate->passes()) {
            Permission::create(['name' => request('name')]);
            return redirect()->route('permission.index')->with('success', 'permission add successfully.');
        }else {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }
    //    This method will insert a permission in DB 25
    public function edit($id) {
        $permission = Permission::findORfail($id);
        return view('permission.create', ['permission' => $permission]);
    }
    // This method will update a permission
    public function update(Request $request, $id){
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'unique:permissions,name,' . $id],
        ]);
        $permission = Permission::findOrFail($id);
    
        if ($validate->passes()) {
            $permission->update(['name' => $request->input('name')]);
    
            return redirect()->route('permission.index')->with('success', 'Permission updated successfully.');
        } else {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    }
    
    // This method will delete a permission
    public function destroy($id)
    {
        try {
            $permission = Permission::findOrFail($id); // Ensure the permission exists
            $permission->delete(); // Perform deletion
            return redirect()->route('permission.index')->with('success', 'Permission deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('permission.index')->with('error', 'Failed to delete permission.');
        }
    }
    
}
