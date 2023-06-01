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
        if (auth()->user()->can('role-permission-list')) {
        $role_permissions = Role::with('permissions')->get();
        return view('role_permission.index', compact('role_permissions'));
        }

        abort(403, "You have no permission! 😒");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('role-permission-create')) {
            $roles = Role::select('id', 'name')->get();
            $permissions = Permission::select('id', 'name')->get();
            return view('role_permission.create', compact('roles', 'permissions'));
        }

        abort(403, "You have no permission! 😒");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('role-permission-create')) {

            $request->validate([
                'role_id' => 'required|exists:roles,id',
            ]);
            try {
                DB::beginTransaction();

                for ($i = 0; $i < count($request->permission_id); $i++) {

                    RolePermission::insert([
                        'role_id' =>  $request->role_id,
                        'permission_id' => $request->permission_id[$i],
                    ]);
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return back()->with('error', $ex->getMessage());
            }

            return redirect()->route('role-permission.index')->with('success', 'RolePermission has been created successfully.');
        }

        abort(403, "You have no permission! 😒");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (auth()->user()->can('role-permission-edit')) {
            $role = Role::whereId($id)->select('id', 'name')->first();
            $permissions = Permission::select('id', 'name')->get();
            $rolePermission = RolePermission::where('role_id', $id)->get();
            return view('role_permission.edit', compact('role', 'permissions', 'rolePermission'));
        }

        abort(403, "You have no permission! 😒");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (auth()->user()->can('role-permission-edit')) {
            $deletedID = [];
            $insertID = [];
            $getallPermission = RolePermission::where('role_id', $request->role_id)->get();

            try {
                DB::beginTransaction();
                if (count($getallPermission) > 0) {
                    //update role permission
                    $deletedIds = array_diff($getallPermission->pluck('permission_id')->toArray(), $request->permission_id);
                    $insertIds  = array_diff($request->permission_id, $getallPermission->pluck('permission_id')->toArray());

                    if (count($deletedIds) > 0) {
                        RolePermission::whereIn('permission_id', $deletedIds)->delete();
                    }

                    if (count($insertIds) > 0) {
                        foreach ($insertIds as $key => $insertId) {
                            RolePermission::insert([
                                'role_id' =>  $request->role_id,
                                'permission_id' => $insertId,
                            ]);
                        }
                    }
                } else {

                    //create role permission
                    for ($i = 0; $i < count($request->permission_id); $i++) {
                        RolePermission::insert([
                            'role_id' =>  $request->role_id,
                            'permission_id' => $request->permission_id[$i],
                        ]);
                    }
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return back()->with('error', $ex->getMessage());
            }
            return redirect()->route('role-permission.index')->with('success', 'RolePermission has been created successfully.');
        }

        abort(403, "You have no permission! 😒");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->can('role-permission-delete')) {
            try {
                DB::beginTransaction();
                RolePermission::where('role_id', $id)->delete();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return back()->with('error', $ex->getMessage());
            }
            return redirect()->route('role-permission.index')->with('success', 'RolePermission has been deleted successfully.');
        }

        abort(403, "You have no permission! 😒");
    }
}
