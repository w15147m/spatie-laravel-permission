<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class UserController extends Controller implements HasMiddleware
 {
    public static function  middleware(): array
    {
        return [
            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:edit users', only: ['edit']),
            new Middleware('permission:create users', only: ['create']),
            new Middleware('permission:delete users', only: ['destroy']),
        ];
    }


  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        // $hasRoles = $users->roles->pluck('id');
        return view('users.index', ['users' => $users]);
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
        //
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
        $user = User::findORfail($id);
        $roles = Role::orderBy('name', 'ASC')->paginate(10);
        $hasRoles = $user->roles->pluck('id');
        return view('users.create', ['user' => $user, 'roles' => $roles, 'hasRoles' => $hasRoles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('user.edit', $id)->withInput()->withErrors($validator); 
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->syncRoles($request->roles);
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
