<?php
use Illuminate\Support\Facades\Route;


Route::get('/byabasaye', [App\Http\Controllers\ByabasayeControllers\HomeController::class, 'index'])->name('byabasaye');


Route::get('/permission-letter', [App\Http\Controllers\ByabasayeControllers\PermissionLetterController::class, 'index'])->name('permission-letter');
Route::get('/permission-letter/create', [App\Http\Controllers\ByabasayeControllers\PermissionLetterController::class, 'create'])->name('permission-letter-create');
