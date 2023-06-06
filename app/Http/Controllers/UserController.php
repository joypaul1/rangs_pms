<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\UserPermission;
use App\Models\UserRole;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('user-list')) {
            $users = User::with('roles')->get();
            return view('user.index', compact('users'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('user-create')) {
            $roles = Role::select('id', 'name')->get();

            return view('user.create', compact('roles'));
        }
        abort(403, "You have no permission! 😒");
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string'],
            'user_id' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (auth()->user()->can('user-create')) {
            $this->validator($request->all());

            try {
                DB::beginTransaction();
                $user = User::create([
                    'name' => $request['name'],
                    'mobile' => $request['mobile'],
                    'email' => $request['email'],
                    'user_id' => $request['user_id'],
                    'password' => md5($request['password']),
                ]);
                if ($request->role_id) {
                    $user = User::find($user->id);
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
                return redirect()->back()->with('error',  $ex->getMessage());
            }

            return redirect()->route('user.index')->with('success', 'User has been created successfully.');
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
        if (auth()->user()->can('user-edit')) {
            $roles = Role::select('id', 'name')->get();
            $user = User::whereId($id)->with('roles')->first();
            return view('user.edit', compact('roles', 'user'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->can('user-edit')) {

            $request->validate([
                'name' => 'required|string|max:255',
                'mobile' => 'required|string|unique:users,mobile, ' . $id,
                'user_id' => 'required|string|unique:users,user_id,' . $id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => ['nullable', 'string', 'min:4', 'confirmed'],
            ]);
            try {
                DB::beginTransaction();
                $user =  User::whereId($id)->first();
                $user->update([
                    'name' => $request['name'],
                    'mobile' => $request['mobile'],
                    'email' => $request['email'],
                    'user_id' => $request['user_id']
                ]);
                if ($request->password) {
                    $user->update(['password' => md5($request['password'])]);
                }
                if ($request->role_id) {
                    $this->setRolePermission($request, $id, $user);
                }else{
                    $this->deleteRolePermission($user);

                }
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return redirect()->back()->with('error',  $ex->getMessage());
            }
            return redirect()->route('user.index')->with('success', 'User has been Updated successfully.');
        }
        abort(403, "You have no permission! 😒");
    }

    private function setRolePermission($request, $id, $user)
    {
        $deletedIds = [];
        $insertIds = [];
        $getallRole = UserRole::where('user_id', $id)->get();
        if (count($getallRole) > 0) {
            //update user role
            $deletedIds = array_diff($getallRole->pluck('role_id')->toArray(), $request->role_id);
            $insertIds  = array_diff($request->role_id, $getallRole->pluck('role_id')->toArray());
            if (count($deletedIds) > 0) {
                foreach ($deletedIds as $key => $deletedId) {
                    $role_permissions = RolePermission::whereRoleId($deletedId)->get();
                    //delete role wise user permission
                    foreach ($role_permissions as $key => $role_perm) {
                        UserPermission::where([
                            ['user_id', $user->id],
                            ['permission_id', $role_perm->permission_id]
                        ])->first()->delete();
                    }
                    //delete user role
                    UserRole::where('user_id', $id)->where('role_id', $deletedId)->delete();
                }
            }
            if (count($insertIds) > 0) {
                foreach ($insertIds as $key => $insertId) {
                    //create user role
                    UserRole::insert([
                        'user_id' =>  $id,
                        'role_id' => $insertId,
                    ]);
                    $role_permissions = RolePermission::whereRoleId($insertId)->get();
                    //create role wise user permission
                    foreach ($role_permissions as $key => $role_perm) {
                        UserPermission::insert([
                            'user_id' => $user->id,
                            'permission_id' => $role_perm->permission_id,
                        ]);
                    }
                }
            }
        } else {
            //create new user role
            for ($i = 0; $i < count($request->role_id); $i++) {
                //create user role
                UserRole::insert([
                    'user_id' =>  $id,
                    'role_id' => $request->role_id[$i],
                ]);
                $role_permissions = RolePermission::whereRoleId($request->role_id[$i])->get();
                //create role wise user permission
                foreach ($role_permissions as $key => $role_perm) {
                    UserPermission::insert([
                        'user_id' => $user->id,
                        'permission_id' => $role_perm->permission_id,
                    ]);
                }
            }
        }
    }


    private  function deleteRolePermission( $user)
    {
        $getPermission = UserPermission::whereUserId($user->id)->get();
        $getRole = UserRole::whereUserId($user->id)->get();

        if(count( $getPermission ) > 0){
            foreach ($getPermission as $key => $perm) {
                $perm->delete();
            }
        }
        if(count( $getRole ) > 0){
            foreach ($getRole as $key => $role) {
                $role->delete();
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->can('user-delete')) {
            try {
                DB::beginTransaction();
                $user = User::whereId($id)->first();
                $this->deleteRolePermission( $user);
                $user->delete();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                // return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
                return response()->json(['status' => false, 'mes' => 'Sorry! This Data Related with others Data Table!']);
            }
            return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
        }
        abort(403, "You have no permission! 😒");
    }
}
