<?php

use App\Http\Controllers\SharedControllers\RoleAndPermissionController;
use App\Http\Controllers\SharedControllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('shared.home');
})->middleware('auth')->name('home');

Auth::routes();



// PIS
Route::get('/pis', [App\Http\Controllers\PisControllers\HomeController::class, 'index'])->name('pis');
Route::get('/staff_form', [App\Http\Controllers\PisControllers\StaffController::class, 'staff_form'])->name('staff_form');
Route::get('/staff_sub_category', [App\Http\Controllers\PisControllers\StaffController::class, 'get_setup_staff_sub_category'])->name('staff_sub_category');



// Nagadi
Route::get('/nagadi', [App\Http\Controllers\NagadiControllers\HomeController::class, 'index'])->name('nagadi');

// USER & ROLES AND PERMISSION
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::resource('role', RoleAndPermissionController::class);
Route::post('/users', [UserController::class, 'store'])
->name('user.store')
->middleware('can:ADD_USER');

Route::get('permission', [RoleAndPermissionController::class, 'indexPermission'])
    ->name('permission.index')
    ->middleware('can:VIEW_PERMISSION');

Route::post('permission', [RoleAndPermissionController::class, 'storePermission'])
    ->name('permission.store')
    ->middleware('can:ADD_PERMISSION');

Route::get('manage-permission/{role}', [RoleAndPermissionController::class, 'managePermission'])
    ->name('permission.managePermission')
    ->middleware('can:PERMISSION_MANAGEMENT');

// Shared
Route::get('/setting/bank', [App\Http\Controllers\SharedControllers\SettingController::class, 'bank_list'])->name('setting_bank');
Route::post('/setting/bank', [App\Http\Controllers\SharedControllers\SettingController::class, 'storeBank'])->name('bank.store');
Route::put('/setting/bank/update/{bank}', [App\Http\Controllers\SharedControllers\SettingController::class, 'updateBank'])->name('bank.update');
Route::get('/setting', [App\Http\Controllers\SharedControllers\SettingController::class, 'list'])->name('setting.list');
Route::post('/setting', [App\Http\Controllers\SharedControllers\SettingController::class, 'storeSetting'])->name('setting.store_setting');
Route::put('/setting/{setting}', [App\Http\Controllers\SharedControllers\SettingController::class, 'editSetting'])->name('setting.edit_setting');
Route::get('/setting/getById', [App\Http\Controllers\SharedControllers\SettingController::class, 'getById'])->name('setting.getById');
Route::get('/setting/{slug}', [App\Http\Controllers\SharedControllers\SettingController::class, 'index'])->name('setting');
Route::post('/setting/addOrUpdate', [App\Http\Controllers\SharedControllers\SettingController::class, 'store'])->name('setting.store');
Route::get('/address/get_districts', [App\Http\Controllers\SharedControllers\AddressController::class, 'get_districts'])->name('address.district');
Route::get('/address/get_municipality', [App\Http\Controllers\SharedControllers\AddressController::class, 'get_municipalities'])->name('address.municipality');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
