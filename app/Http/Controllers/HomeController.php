<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function userList()
    {
        $users = User::all();
        return view('userList', compact('users'));

        // $conn = oci_connect("DEVELOPERS2", "Test1234", "192.168.172.61:1521/xe");
        // if (!$conn) {
        //     $e = oci_error();
        //     trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        // }

        // $stid = oci_parse($conn, 'SELECT * FROM RML_HR_APPS_USER');
        // oci_execute($stid);

        // $nrows = oci_fetch_all($stid, $res);

        // // echo "$nrows rows fetched<br>\n";
        // // dd($res);
        // oci_free_statement($stid);
        // oci_close($conn);
        // return view('userList', compact('res', 'nrows'));


    }



    public function demoInsertData()
    {
        try {
            DB::beginTransaction();
            $user_permission = Permission::firstOrCreate([
                'name' => 'Create Task'
            ], [
                'slug' => Str::slug('Create Task')
            ]);
            $admin_permission = Permission::firstOrCreate([
                'name' => 'Edit User'
            ], [
                'slug' => Str::slug('Edit User')
            ]);

            //RoleTableSeeder

            //normal user role
            $user_role = new Role();
            $user_role->slug = 'user';
            $user_role->name = 'User';
            $user_role->save(); //  role name save
            $user_role->permissions()->attach($user_permission);
            //end normal user role

            //admin user role
            $admin_role = new Role();
            $admin_role->slug = 'admin';
            $admin_role->name = 'Admin';
            $admin_role->save(); //  role name save
            $admin_role->permissions()->attach($admin_permission);
            //end admin user role

            $user_role = Role::firstOrCreate([
                'name' => 'User'
            ], [
                'slug' => Str::slug('user')
            ]);
            $admin_role = Role::firstOrCreate([
                'name' => 'Admin'
            ], [
                'slug' => Str::slug('admin')
            ]);;

            $createTasks = new Permission();
            $createTasks->slug = 'create-tasks';
            $createTasks->name = 'Create Tasks';
            $createTasks->save(); //Permission create
            $createTasks->roles()->attach($user_role);

            $editUsers = new Permission();
            $editUsers->slug = 'edit-users';
            $editUsers->name = 'Edit Users';
            $editUsers->save();  //Permission create
            $editUsers->roles()->attach($admin_role); // roles permissions table insert permission

            $user_role = Role::firstOrCreate([
                'name' => 'user'
            ], ['slug' => 'user']);
            $admin_role = Role::firstOrCreate([
                'name' => 'admin'
            ], ['slug' => 'admin']);
            $user_perm = Permission::where('slug', 'create-tasks')->first();
            $admin_perm = Permission::where('slug', 'edit-users')->first();

            $user = new User();
            $user->name = 'Test_User';
            $user->mobile = '000000000';
            $user->user_id = 'RML-01261';
            $user->email = 'test_user@gmail.com';
            $user->password = Hash::make('1234567890');
            $user->save();
            
            $user->permissions()->attach($user_perm);

            $admin = new User();
            $admin->name = 'Test_Admin';
            $admin->email = 'test_admin@gmail.com';
            $admin->mobile = '000000001';
            $admin->user_id = 'RML-01260';
            $admin->password = Hash::make('1234567890');
            $admin->save();
            $admin->roles()->attach($admin_role);
            $admin->permissions()->attach($admin_perm);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->back()->with('success', 'Data Inserted Successfully');
    }
}
