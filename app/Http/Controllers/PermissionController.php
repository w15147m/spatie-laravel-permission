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
        $permissions = Permission::orderBy('created_at', 'asc')->paginate(10);
        return view('permission.list', ['permissions' => $permissions]);
    }
    // This method will show create permission page
    public function create() {
        return view('permission.create');
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
    public function edit() {}
    // This method will update a permission
    public function update() {}
    // This method will delete a permission
    public function destroy() {}
}
