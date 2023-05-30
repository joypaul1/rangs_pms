<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionConctroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role_permissions = Role::with('permissions')->get();
        return view('role_permission.index', compact('role_permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        $permissions = Permission::select('id', 'name')->get();
        return view('role_permission.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
        try {
            DB::beginTransaction();
            // dd($request->all());
            for ($i = 0; $i < count($request->permission_id); $i++) {

                $role_permission = RolePermission::insert([
                    'role_id' =>  $request->role_id,
                    'permission_id' => $request->permission_id[$i],
                ]);
                // dd($role_permission);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            // dd($ex->getMessage());
            return back()->with('error', $ex->getMessage());
        }

        return redirect()->route('role-permission.index')->with('success', 'RolePermission has been created successfully.');
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
        return view('role_permission.edit');
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
