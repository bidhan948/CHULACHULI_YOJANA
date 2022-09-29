<?php

use App\Http\Controllers\SharedControllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Nagadi
Route::get('/nagadi', [App\Http\Controllers\NagadiControllers\HomeController::class, 'index'])->name('nagadi');
Route::get('/nagadi_setting', [App\Http\Controllers\NagadiControllers\SettingController::class, 'index'])->name('nagadi-setting');
Route::post('/nagadi_main_sirsak_store', [App\Http\Controllers\NagadiControllers\SettingController::class, 'store_main_sirsak'])->name('nagadi-main-sirsak.store');
Route::post('/nagadi_upa_sirsak_store', [App\Http\Controllers\NagadiControllers\SettingController::class, 'store_upa_sirsak'])->name('nagadi-upa-sirsak.store');
Route::get('/nagadi_dar_create', [App\Http\Controllers\NagadiControllers\SettingController::class, 'dar_create'])->name('nagadi-dar.create');
Route::post('/nagadi_dar_store', [App\Http\Controllers\NagadiControllers\SettingController::class, 'dar_store'])->name('nagadi-dar.store');

Route::get('/nagadi_get_categories_by_pid', [App\Http\Controllers\NagadiControllers\SettingController::class, 'get_categories_by_pid'])->name('nagadi-get-categories');

Route::get('/nagadi_rasid_create', [App\Http\Controllers\NagadiControllers\RasidController::class, 'create'])->name('nagadi-rasid-create');
Route::post('/nagadi_rasid_store', [App\Http\Controllers\NagadiControllers\RasidController::class, 'store'])->name('nagadi-rasid-store');
Route::post('/nagadi_cancel_rasid', [App\Http\Controllers\NagadiControllers\RasidController::class, 'cancel_rasid'])->name('nagadi-cancel_rasid');
Route::get('/nagadi_rasid_list', [App\Http\Controllers\NagadiControllers\RasidController::class, 'index'])->name('nagadi-rasid-list');
Route::get('/nagadi_report/{key}', [App\Http\Controllers\NagadiControllers\RasidController::class, 'report'])->name('nagadi-rasid-report');
Route::post('/nagadi_report/{key}', [App\Http\Controllers\NagadiControllers\RasidController::class, 'report'])->name('nagadi-rasid-report');

Route::get('/rasid_number_list', [App\Http\Controllers\NagadiControllers\RasidController::class, 'rasid_number_list'])->name('rasid_number_list');



