<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleConctroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (auth()->user()->can('role-permission-list')) {
            $user_roles = User::with('roles')->get();
            return view('user_role.index', compact('user_roles'));
        // }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();
        return view('user_role.create', compact('roles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->role_id) {
                $user = User::find($request->user_id);
                for ($i = 0; $i < count($request->role_id); $i++) {
                    $user_role = Role::whereId($request->role_id[$i])->with('permissions')->first();
                    $user_permissions =  $user_role->permissions;
                    $user->roles()->attach($user_role);
                    foreach ($user_permissions as $key => $user_perm) {
                        $user->permissions()->attach($user_perm);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
            return back()->with('error', $ex->getMessage());
        }

        return redirect()->route('user-role.index')->with('success', 'UserRolePermission has been created successfully.');

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
        $roles = Role::select('id', 'name')->get();
        $user = User::whereId($id)->select('id', 'name')->get();
        return view('user_role.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
