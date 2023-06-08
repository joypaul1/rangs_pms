<?php

use App\Http\Controllers\Authentic\CustomAuthController;
use App\Http\Controllers\Leave\LeaveController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PMS\KpiController;
use App\Http\Controllers\PMS\KraController;
use App\Http\Controllers\PMS\PmsController;
use App\Http\Controllers\PMS\PMSYearController;
use App\Http\Controllers\Report\AttendanceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionConctroller;
use App\Http\Controllers\Tour\TourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleConctroller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('auth');


// custom login route list
Route::get('login', [CustomAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [CustomAuthController::class, 'login'])->name('login');
Route::post('logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('user-list', [App\Http\Controllers\HomeController::class, 'userList'])->name('user.list');
// authentication route list
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('user-list', [App\Http\Controllers\HomeController::class, 'userList'])->name('user.list');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role-permission', RolePermissionConctroller::class);
    Route::resource('user-role', UserRoleConctroller::class);
    Route::resource('leave', LeaveController::class);
    Route::resource('tour', TourController::class);
    Route::resource('reeport', AttendanceController::class);


    //pms
    Route::group(['prefix' => 'pms', 'as' => 'pmsConfig.'], function () {
        Route::resource('home', PmsController::class);
        Route::resource('year', PMSYearController::class);
        Route::resource('kra', KraController::class);
        Route::resource('kpi', KpiController::class);
    });
});



Route::get('admin-role-permission', function () {
    // dd(auth()->user()->can('pms-kra-list'));
    return Permission::whereSlug('pms-kra-list')->first();
    // try {
    //     DB::beginTransaction();
    //     $user = User::with('roles', 'permissions')->first();
    //     // create super admin role
    //     $user_role = Role::whereId(1)->with('permissions')->first();
    //     $user_permissions =  $user_role->permissions;
    //     // create super admin role wise permission
    //     foreach ($user_permissions as $key => $user_perm) {
    //         UserPermission::insert([
    //             'user_id' => $user->id,
    //             'permission_id' => $user_perm->id,
    //         ]);
    //     }
    //     DB::commit();
    // } catch (\Exception $ex) {
    //     DB::rollBack();
    //     dd($ex->getMessage(), $ex->getLine());
    // }
    dd('done');
});
