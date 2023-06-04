<?php

use App\Http\Controllers\Leave\LeaveController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PMS\KraController;
use App\Http\Controllers\PMS\PMSYearController;
use App\Http\Controllers\Report\AttendanceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionConctroller;
use App\Http\Controllers\Tour\TourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleConctroller;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('user-list', [App\Http\Controllers\HomeController::class, 'userList'])->name('user.list');
Route::resource('user', UserController::class);
Route::resource('role', RoleController::class);
Route::resource('permission', PermissionController::class);
Route::resource('role-permission', RolePermissionConctroller::class);
Route::resource('user-role', UserRoleConctroller::class);
Route::resource('leave',LeaveController::class);
Route::resource('tour',TourController::class);
Route::resource('reeport',AttendanceController::class);

//pms
Route::group(['middleware' => 'auth', 'prefix' => 'pms', 'as' => 'pmsConfig.'],function(){
    Route::resource('year', PMSYearController::class);
    Route::resource('kra', KraController::class);
});
