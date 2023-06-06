<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleConctroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('user-role-list')) {
            $user_roles = User::with('roles')->get();
            return view('user_role.index', compact('user_roles'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('user-role-store')) {
            $roles = Role::select('id', 'name')->get();
            $users = User::select('id', 'name')->get();
            return view('user_role.create', compact('roles', 'users'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('user-role-store')) {

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

            return redirect()->route('user-role.index')->with('success', 'UserRole has been created successfully.');
        }
        abort(403, "You have no permission! 😒");
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
        if (auth()->user()->can('user-role-edit')) {
            $roles = Role::select('id', 'name')->get();
            $user = User::whereId($id)->select('id', 'name')->with('roles')->first();
            return    view('user_role.edit', compact('roles', 'user'));
        }

        abort(403, "You have no permission! 😒");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all(), $id);
        if (auth()->user()->can('user-role-edit')) {
            $deletedIds = [];
            $insertIds = [];
            $getallRole = UserRole::where('user_id', $id)->get();
            try {
                DB::beginTransaction();
                if (count($getallRole) > 0) {
                    //update user role
                    $deletedIds = array_diff($getallRole->pluck('role_id')->toArray(), $request->role_id);
                    $insertIds  = array_diff($request->role_id, $getallRole->pluck('role_id')->toArray());

                    if (count($deletedIds) > 0) {
                        foreach ($deletedIds as $key => $deletedId) {
                            UserRole::where('user_id', $id)->where('role_id', $deletedId)->delete();
                        }
                    }
                    if (count($insertIds) > 0) {
                        foreach ($insertIds as $key => $insertId) {
                            UserRole::insert([
                                'user_id' =>  $id,
                                'role_id' => $insertId,
                            ]);
                        }
                    }
                } else {
                    //create user role
                    for ($i = 0; $i < count($request->role_id); $i++) {
                        UserRole::insert([
                            'user_id' =>  $id,
                            'role_id' => $request->role_id[$i],
                        ]);
                    }
                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return back()->with('error', $ex->getMessage());
            }
            return redirect()->route('user-role.index')->with('success', 'UserRole has been Updated successfully.');
        }

        abort(403, "You have no permission! 😒");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->can('user-role-delete')) {
            try {
                DB::beginTransaction();
                UserRole::where('user_id', $id)->delete();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return response()->json(['status' => false, 'mes' => 'Sorry! This Data Related with others Data Table!']);

                // return back()->with('error', $ex->getMessage());
            }
            return redirect()->route('user-role.index')->with('success', 'UserRole has been deleted successfully.');
        }

        abort(403, "You have no permission! 😒");
    }
}
