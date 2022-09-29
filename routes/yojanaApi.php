<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\YojanaControllers\ApiHelperController;
use App\Http\Controllers\YojanaControllers\ApiReportController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('budget-source-amount',[ApiHelperController::class,'getBudgetSourceAmount'])->name('api.getBudgetSourceAmount');
Route::post('api/plan',[ApiReportController::class,'plan'])->name('api.plan.report');
Route::get('api/get-program-antim-bhuktani',[ApiHelperController::class,'getProgramAntimBhuktani'])->name('api.getProgramAntimBhuktani');
Route::get('api/get-budget-row-plan',[ApiHelperController::class,'getBudgetRowTr'])->name('api.getBudgetRowTr');
Route::get('get-topic-area-type-id',[ApiHelperController::class,'getTopicAreaType'])->name('api.getTopicAreaType');
Route::get('get-bank-name',[ApiHelperController::class,'getBankName'])->name('api.getBankName');
Route::get('get-tole-bikas-samiti-detail',[ApiHelperController::class,'getToleBikasSamitiDetail'])->name('api.getToleBikasSamitiDetail');
Route::get('get-anugaman-samiti',[ApiHelperController::class,'getAnugmanSamiti'])->name('api.getAnugmanSamiti');
Route::get('get-anugaman-samiti-by-id',[ApiHelperController::class,'getAnugmanSamitiById'])->name('api.getAnugmanSamitiById');
Route::get('get-post-by-staff-id',[ApiHelperController::class,'getPostByStaffId'])->name('api.getPostByStaffId');
Route::get('get-child-role',[ApiHelperController::class,'getChildRole'])->name('api.getChildRole');
Route::get('get-raw-suchi-darta-field',[ApiHelperController::class,'getRawSuchiDartField'])->name('api.getRawSuchiDartaField');
Route::get('get-suchi-darta-bibaran',[ApiHelperController::class,'getSuchiDartaBibaran'])->name('api.getSuchiDartaBibaran');
Route::get('get-sub-list-registration',[ApiHelperController::class,'getSubListRegistration'])->name('api.getSubListRegistration');
Route::get('get-work-order-by-id',[ApiHelperController::class,'getWorkOrderById'])->name('api.getWorkOrderById');
Route::get('get-plan-name-by-reg-no',[ApiHelperController::class,'getPlanName'])->name('api.getPlanName');
Route::get('get-amount-by-work-order-id',[ApiHelperController::class,'getAmountByworkOrderId'])->name('api.program.getAmountByworkOrderId');
Route::get('get-period-by-work-order-no',[ApiHelperController::class,'getPeriodByWorkOrderNo'])->name('api.program.getPeriodByWorkOrderNo');
Route::get('get-plan-own-evaluation-amount',[ApiHelperController::class,'getPlanOwnEvaluationAmount'])->name('plan.api.getPlanOwnEvaluationAmount');
Route::post('get-yojana-report',[ApiHelperController::class,'getYojanaReport'])->name('api.yojana.report');
