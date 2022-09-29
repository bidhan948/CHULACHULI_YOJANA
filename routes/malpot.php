<?php
use Illuminate\Support\Facades\Route;

Route::get('/malpot', [App\Http\Controllers\MalpotControllers\HomeController::class, 'index'])->name('malpot');
Route::get('/haal_sabik_list', [App\Http\Controllers\MalpotControllers\SettingController::class, 'haal_sabik_list'])->name('haal_sabik_list');
Route::get('/get_haal_from_sabik', [App\Http\Controllers\MalpotControllers\SettingController::class, 'get_haal_from_sabik'])->name('get_haal_from_sabik');
Route::post('/haal_sabik_store', [App\Http\Controllers\MalpotControllers\SettingController::class, 'haal_sabik_store'])->name('haal_sabik_store');
Route::get('/land_rate_list', [App\Http\Controllers\MalpotControllers\SettingController::class, 'land_rate_list'])->name('land_rate_list');
Route::post('/land_rate_store', [App\Http\Controllers\MalpotControllers\SettingController::class, 'land_rate_store'])->name('land_rate_store');


Route::get('/get_land_profile_list', [App\Http\Controllers\MalpotControllers\ProfileController::class, 'get_land_profile_list'])->name('get_land_profile_list');
Route::get('/land_profile_list', [App\Http\Controllers\MalpotControllers\ProfileController::class, 'land_profile_list'])->name('land_profile_list');
Route::get('/land_profile_add', [App\Http\Controllers\MalpotControllers\ProfileController::class, 'land_profile_add'])->name('land_profile_add');
Route::post('/land_profile_store', [App\Http\Controllers\MalpotControllers\ProfileController::class, 'land_profile_store'])->name('land_profile_store');


Route::get('/land_detail_list/{land_owner_id}', [App\Http\Controllers\MalpotControllers\LandDetailController::class, 'land_detail_list'])->name('land_detail_list');
Route::get('/land_detail_add/{land_owner_id}', [App\Http\Controllers\MalpotControllers\LandDetailController::class, 'land_detail_add'])->name('land_detail_add');
Route::post('/land_detail_store', [App\Http\Controllers\MalpotControllers\LandDetailController::class, 'land_detail_store'])->name('land_detail_store');

Route::get('/malpot_rasid_create/{land_owner_id}', [App\Http\Controllers\MalpotControllers\MalpotRasidController::class, 'malpot_rasid_create'])->name('malpot_rasid_create');
