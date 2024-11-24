<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

use function PHPUnit\Framework\returnSelf;

class PermissionController extends Controller
{
    // This method will show permissions page
    public function index() {
        $permissions = Permission::orderBy('created_at', 'asc')->paginate(5);
        return view('permission.list', ['permissions' => $permissions]);
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
            return redirect()->route('permission.list')->with('success', 'permission add successfully.');
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
    
            return redirect()->route('permission.list')->with('success', 'Permission updated successfully.');
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
            return redirect()->route('permission.list')->with('success', 'Permission deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('permission.list')->with('error', 'Failed to delete permission.');
        }
    }
    
}
