<?php

use App\Http\Controllers\PisControllers\StaffController;
use Illuminate\Support\Facades\Route;


Route::prefix('staff')->group(function () {
    Route::post("page1", [StaffController::class, "staff_form_page_1_save"])->name('page_1_submit');
    
    Route::get('page2',[StaffController::class,'staff_form_page_2'])->name('page_2_show');
    Route::post("page2", [StaffController::class, "staff_form_page_2_save"])->name('page_2_submit');
    
    Route::get('page3',[StaffController::class,'staff_form_page_3'])->name('page_3_show');
    Route::post("page3", [StaffController::class, "staff_form_page_3_save"])->name('page_3_submit');

    Route::get('page4',[StaffController::class,'staff_form_page_4'])->name('page_4_show');
    Route::post('page4',[StaffController::class,"staff_form_page_4_save"])->name('page_4_submit');

    Route::get('page5',[StaffController::class,'staff_form_page_5'])->name('page_5_show');
    Route::post('page5',[StaffController::class,"staff_form_page_5_save"])->name('page_5_submit');

    Route::get('page6',[StaffController::class,'staff_form_page_6'])->name('page_6_show');
    Route::post('page6',[StaffController::class,'staff_form_page_6_save'])->name('page_6_submit');

    Route::get('page7',[StaffController::class,'staff_form_page_7'])->name('page_7_show');
    Route::post('page7',[StaffController::class,'staff_form_page_7_save'])->name('page_7_submit');

    Route::get('page8',[StaffController::class,'staff_form_page_8'])->name('page_8_show');
    Route::post('page8',[StaffController::class,'staff_form_page_8_save'])->name('page_8_submit');

    Route::get('page9',[StaffController::class,'staff_form_page_9'])->name('page_9_show');
    Route::post('page9',[StaffController::class,'staff_form_page_9_save'])->name('page_9_submit');

    Route::get('page10',[StaffController::class,'staff_form_page_10'])->name('page_10_show');
    Route::post('page10',[StaffController::class,'staff_form_page_10_save'])->name('page_10_submit');

    Route::get('page11',[StaffController::class,'staff_form_page_11'])->name('page_11_show');
    Route::post('page11',[StaffController::class,'staff_form_page_11_save'])->name('page_11_submit');

    Route::get('page12',[StaffController::class,'staff_form_page_12'])->name('page_12_show');
    Route::post('page12',[StaffController::class,'staff_form_page_12_save'])->name('page_12_submit');

    Route::get('page13',[StaffController::class,'staff_form_page_13'])->name('page_13_show');
    Route::post('page13',[StaffController::class,'staff_form_page_13_save'])->name('page_13_submit');

    Route::get('page14',[StaffController::class,'staff_form_page_14'])->name('page_14_show');
    Route::post('page14',[StaffController::class,'staff_form_page_14_save'])->name('page_14_submit');

    });
// ?>