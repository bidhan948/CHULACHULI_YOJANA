<?php

use App\Http\Controllers\ThekkaController;
use App\Http\Controllers\YojanaController\setting\StaffController;
use App\Http\Controllers\YojanaControllers\{
    AdvanceController,
    ConsumerController,
    FinalPaymentController,
    HomeController,
    KulLagatController,
    LetterController,
    MergeController,
    OtherBibaranController,
    PlanController,
    RunningBillPaymentController,
    ToleBikasSamitiController,
    TypeController,
    SamitiGathanController
};
use App\Http\Controllers\YojanaControllers\program\ProgramAddDeadLineController;
use App\Http\Controllers\YojanaControllers\program\ProgramAdvanceController;
use App\Http\Controllers\YojanaControllers\program\ProgramFinalPaymentController;
use App\Http\Controllers\YojanaControllers\program\ProgramKulLagatController;
use App\Http\Controllers\YojanaControllers\program\ProgramLetterController;
use App\Http\Controllers\YojanaControllers\program\WorkOrderBudgetController;
use App\Http\Controllers\YojanaControllers\ReportController;
use App\Http\Controllers\YojanaControllers\setting\{
    AmanatController,
    AnugamanSamitiController,
    ContingencyController,
    DecimalPointController,
    DeductionControllers,
    ExcelUploaderController,
    InstiutionalCommitteeController,
    ListRegistrationController,
    TermsController
};
use Illuminate\Support\Facades\Route;

Route::get('clear',function(){
    Artisan::call('optimize:clear');
});

Route::group(['middleware' => 'auth'], function () {
    // YOJANA
    Route::get('/plan', [App\Http\Controllers\YojanaControllers\HomeController::class, 'index'])->name('yojana');
    Route::prefix('yojana')->group(function () {
        // budget source
        Route::get('/budget-sources', [App\Http\Controllers\YojanaControllers\BudgetSourceController::class, 'index'])
            ->name('budget-sources');
        Route::get('/new-plan', [PlanController::class, 'create'])
            ->name('new-plan');
        Route::get('/plan', [PlanController::class, 'index'])
            ->name('plan.index');
        Route::get('/plan/edit/{plan}', [PlanController::class, 'edit'])
            ->name('plan.edit');
        Route::put('/plan/update/{plan}', [PlanController::class, 'update'])
            ->name('plan.update');
        Route::get('/break-down/{plan}', [PlanController::class, 'breakDown'])
            ->name('plan.break');
        Route::post('/break-down/{plan}', [PlanController::class, 'storeBreakYojana'])
            ->name('plan.breakdown');
        Route::post('/plan', [PlanController::class, 'store'])
            ->name('plan.store');
        Route::post('/budget-sources/addOrUpdate', [App\Http\Controllers\YojanaControllers\BudgetSourceController::class, 'store'])
            ->name('budget-sources.store');
        Route::post('/budget-source-amount/add', [App\Http\Controllers\YojanaControllers\BudgetSourceController::class, 'store_amount'])
            ->name('budget-source-amount.store');
        // tole bikas samiti
        Route::get('/tole-bikas-samiti/print/{tole_bikas_samiti}', [ToleBikasSamitiController::class, 'print'])
            ->name('tole-bikas-samiti.print');
        Route::get('/tole-bikas-samiti/bank-print/{tole_bikas_samiti}', [ToleBikasSamitiController::class, 'printBank'])
            ->name('tole-bikas-samiti.print_bank');
        Route::get('/tole-bikas-samiti/bank/{tole_bikas_samiti}', [ToleBikasSamitiController::class, 'bank'])
            ->name('tole-bikas-samiti.bank');
        Route::get('/tole-bikas-samiti/print-praman-patra/{tole_bikas_samiti}', [ToleBikasSamitiController::class, 'printPramanPatra'])
            ->name('tole-bikas-samiti.praman');
        Route::resource('/tole-bikas-samiti', ToleBikasSamitiController::class)->except('destroy');
        //Anugaman samiti
        Route::get('/anugaman-samiti/set-staus/{anugaman_samiti_detail}', [AnugamanSamitiController::class, 'setStatus'])
            ->name('anugaman.setStatus');
        Route::resource('/anugaman-samiti', AnugamanSamitiController::class)->except('destroy');



        // plan operate
        Route::get('/samiti-gathan', [SamitiGathanController::class, 'index'])->name('samiti-gathan.index');
        Route::get('/plan-operate', [SamitiGathanController::class, 'planOperateDashboard'])->name('plan-operate.index');
        Route::get('/plan-operate/{slug}', [SamitiGathanController::class, 'searchPlan'])->name('plan-operate.search');
        Route::post('/plan-operate', [SamitiGathanController::class, 'searchPlanByRegno'])->name('plan-operate.searchSubmit');
        Route::post('/program-operate', [SamitiGathanController::class, 'searchProgramByRegno'])->name('progarm-operate.searchSubmit');
        Route::resource('/contingency', ContingencyController::class);

        // program ROUTES
        Route::get('program-operate', [SamitiGathanController::class, 'programOperateDashboard'])->name('program-operate.index');
        Route::get('program/final-bhuktani/{reg_no}', [ProgramFinalPaymentController::class, 'index'])->name('program.final_bhuktani');
        Route::post('program/final-bhuktani', [ProgramFinalPaymentController::class, 'store'])->name('program.final_bhuktani.store');
        Route::get('work-order/{reg_no}', [WorkOrderBudgetController::class, 'index'])->name('work_order.index');
        Route::get('work-order/kul-lagat/{reg_no}', [ProgramKulLagatController::class, 'index'])->name('work_order.kul_lagat');
        Route::post('work-order/kul-lagat/create', [ProgramKulLagatController::class, 'create'])->name('work_order.create');
        Route::get('work-order/kul-lagat/create/{work_order}', [ProgramKulLagatController::class, 'showForm'])->name('work_order.create_kul_lagat');
        Route::post('work-order/kul-lagat/store', [ProgramKulLagatController::class, 'store'])->name('work_order.kul_lagat.store');
        Route::post('work-order', [WorkOrderBudgetController::class, 'store'])->name('work_order.store');
        Route::get('work-order-edit/{work_order}', [WorkOrderBudgetController::class, 'edit'])->name('work_order.edit');
        Route::put('work-order-edit/{work_order}', [WorkOrderBudgetController::class, 'update'])->name('work_order.update');

        // program advance and antim myad
        Route::get('program/advance/{reg_no}', [ProgramAdvanceController::class, 'index'])->name('program.work_order.advance');
        Route::get('program/add-deadline/{reg_no}', [ProgramAddDeadLineController::class, 'index'])->name('program.add_deadline');
        Route::post('program/add-deadline', [ProgramAddDeadLineController::class, 'store'])->name('program.add_deadline.store');
        Route::put('program/add-deadline/update/{program_add_deadline}', [ProgramAddDeadLineController::class, 'update'])->name('program.add_deadline.update');
        Route::get('program/add-deadline/edit/{program_add_deadline}', [ProgramAddDeadLineController::class, 'edit'])->name('program.add_deadline.edit');
        Route::get('program/advance/edit/{program_advance}', [ProgramAdvanceController::class, 'edit'])->name('program.work_order.advance.edit');
        Route::post('program/advance', [ProgramAdvanceController::class, 'store'])->name('program.work_order.advanceSubmit');
        Route::put('program/advance/edit/{program_advance}', [ProgramAdvanceController::class, 'update'])->name('program.work_order.advanceUpdate');

        // REPORT routes
        Route::prefix('report')->group(function () {
            Route::get('bar-graph', [HomeController::class, 'barGraphReport'])->name('plan.bar_graph');
            Route::get('numeric-report', [ReportController::class, 'numericReport'])->name('report.numerical');
            Route::get('maelpa-report', [ReportController::class, 'malepaReport'])->name('report.malepa');
            Route::get('generate-numeric-report', [ReportController::class, 'generateNumericReport'])->name('report.generateNumericReport');
            Route::get('committee-dashboard', [ReportController::class, 'committeeDashboard'])->name('report.committee.dashboard');
            Route::get('commitee-dashboard-submit',[ReportController::class,'commitee_dashboard_submit'])->name('commitee-dashboard-submit');
            Route::get('{type}', [ReportController::class, 'committeReport'])->name('plan.committe_report');
        });
                Route::get('yojana-detail-report',[ReportController::class,'yojana_detail_report'])->name('report.yojana.detail');


        // setting
        Route::prefix('setting')->group(function () {
            Route::get('deduction', [DeductionControllers::class, 'index'])
                ->name('plan.setting_deduction');
            Route::post('excel', [ExcelUploaderController::class, 'store'])
                ->name('plan.setting.excel_store');
            Route::get('excel', [ExcelUploaderController::class, 'index'])
                ->name('plan.setting.excel');
            Route::get('plan/staff', [StaffController::class, 'index'])
                ->name('plan.setting.staff');
            Route::post('plan/staff', [StaffController::class, 'store'])
                ->name('plan.setting.staff.store');
            Route::put('plan/staff/{staff}', [StaffController::class, 'update'])
                ->name('plan.setting.staff.update');
            Route::post('deduction', [DeductionControllers::class, 'store'])
                ->name('plan.setting_deduction.store');
            Route::put('deduction/update/{deduction}', [DeductionControllers::class, 'update'])
                ->name('plan.setting_deduction.update');
            Route::get('decimal-point', [DecimalPointController::class, 'index'])
                ->name('plan.setting.decimal_point.index');
            Route::post('decimal-point', [DecimalPointController::class, 'store'])
                ->name('plan.setting.decimal_point.store');
            Route::put('decimal-point/update/{decimal_point}', [DecimalPointController::class, 'update'])
                ->name('plan.setting.decimal_point.update');
            Route::get('yojana-merge', [MergeController::class, 'index'])
                ->name('setting.merge_index');
            Route::post('yojana-merge', [MergeController::class, 'store'])
                ->name('setting.merge_store');
            Route::get('list-registration', [ListRegistrationController::class, 'index'])
                ->name('setting.list_registration_index');
            Route::post('list-registration', [ListRegistrationController::class, 'store'])
                ->name('setting.list_registration_store');
            Route::get('list-registration-bibaran', [ListRegistrationController::class, 'bibaranIndex'])
                ->name('setting.list_registration_bibaran_index');
            Route::post('list-registration-bibaran', [ListRegistrationController::class, 'bibaranStore'])
                ->name('setting.list_registration_bibaran_store');
            Route::get('list-registration-bibaran/show', [ListRegistrationController::class, 'bibaranShow'])
                ->name('setting.list_registration_bibaran_show');
            Route::get('list-registration-bibaran/edit/{list_registration_attribute}', [ListRegistrationController::class, 'bibaranEdit'])
                ->name('setting.list_registration_edit');
            Route::PUT('list-registration-bibaran/edit/{list_registration_attribute}', [ListRegistrationController::class, 'bibaranUpdate'])
                ->name('setting.list_registration_update');
            Route::get('list-registration-bibaran/show/{list_registration_attribute}', [ListRegistrationController::class, 'fullBibaranShow'])
                ->name('setting.list_registration_fullBibaranShow');
            Route::get('term', [TermsController::class, 'index'])
                ->name('plan.setting.term.index');
            Route::post('term', [TermsController::class, 'store'])
                ->name('plan.setting.term.store');
            Route::put('term/{term}', [TermsController::class, 'update'])
                ->name('plan.setting.term.update');
        });

        // Program letter route
        Route::get('program/letter/{reg_no}', [ProgramLetterController::class, 'index'])->name('program.letter');
        Route::get('program-letter/work-order/{reg_no}/{route}', [ProgramLetterController::class, 'workOrderLetter'])->name('program.letter.workOrderLetter');
        Route::get('program-letter/peski-letter/{reg_no}/{route}', [ProgramLetterController::class, 'workOrderLetter'])->name('program.letter.advanceLetterForm');
        Route::post('program-letter/work-order', [ProgramLetterController::class, 'workOrderLetterSubmit'])->name('program.letter.workOrderLetterSubmit');
        Route::post('program-letter/program-payment-final', [ProgramLetterController::class, 'programFinalPaymentLetter'])->name('program.letter.programFinalPaymentLetter');
        Route::post('program-letter/program-payment-final-arthik', [ProgramLetterController::class, 'programFinalPaymentArthikLetter'])->name('program.letter.programFinalPaymentArthikLetter');
        Route::get('program-letter/peski-letter/{reg_no}', [ProgramLetterController::class, 'peskiLetterDashboard'])->name('program.letter.peskiLetterDashboard');
        Route::get('program-letter/final-payment-letter/', [ProgramLetterController::class, 'printProgramFinalPaymentLetter'])->name('print.program.letter.printProgramFinalPaymentLetter');
        Route::get('program-letter/final-payment-letter-arthik/', [ProgramLetterController::class, 'printProgramFinalPaymentArthikLetter'])->name('print.program.letter.printProgramFinalPaymentArthikLetter');
        Route::get('print/program-letter/work-order', [ProgramLetterController::class, 'printWorkOrderLetter'])->name('print.program.letter.printWorkOrderLetter');
        Route::post('program-letter/work-order-2', [ProgramLetterController::class, 'workOrderLetterTwoSubmit'])->name('program.letter.workOrderLetterTwo');
        Route::get('print/program-letter/work-order-2', [ProgramLetterController::class, 'printWorkOrderLetterTwo'])->name('print.program.letter.printWorkOrderLetterTwo');
        Route::post('program-letter/agreement-letter', [ProgramLetterController::class, 'agreementLetter'])->name('program.letter.agreementLetter');
        Route::get('print/program-letter/agreement-letter', [ProgramLetterController::class, 'printAgreementLetter'])->name('print.program.letter.printAgreementLetter');
        Route::post('program-letter/financial-administration-letter', [ProgramLetterController::class, 'financialAdministrationLetter'])->name('program.letter.financialAdministrationLetter');
        Route::post('program-letter/peski-letter', [ProgramLetterController::class, 'advanceLetter'])->name('program.letter.advanceLetter');
        Route::get('print/program-letter/peski-letter', [ProgramLetterController::class, 'printadvanceLetter'])->name('print.program.letter.printadvanceLetter');
        Route::get('print/program-letter/financial-administration-letter', [ProgramLetterController::class, 'printFinancialAdministrationLetter'])->name('print.program.letter.printFinancialAdministrationLetter');

        Route::group(['middleware' => 'type'], function () {
            // Letter routes
            Route::get('letter/{reg_no}', [LetterController::class, 'index'])->name('letter.dashboard');
            Route::get('letter/contract/{reg_no}', [LetterController::class, 'contractTippaniLetter'])->name('letter.contract');
            Route::get('letter/running-bill-payment/dashboard/{reg_no}', [LetterController::class, 'runningBillPaymentLetterDashboard'])->name('plan.letter.runningBillPaymentLetterDashboard');
            Route::get('letter/running-bill-payment/{reg_no}/{route}', [LetterController::class, 'runningBillPaymentLetter'])->name('plan.letter.runningBillPaymentLetter');
            Route::post('letter/running-bill-payment', [LetterController::class, 'runningBillPaymentLetterSubmit'])->name('plan.letter.runningBillPaymentLetterSubmit');
            Route::post('letter/account-payment-letter', [LetterController::class, 'accountPaymentLetterSubmit'])->name('plan.letter.accountPaymentLetterSubmit');
            Route::get('print/letter/running-bill-payment', [LetterController::class, 'printRunningBillPaymentLetter'])->name('plan.letter.printRunningBillPaymentLetter');
            Route::get('print/letter/account-payment-letter', [LetterController::class, 'printAccountPaymentLetter'])->name('plan.letter.printAccountPaymentLetter');
            Route::get('letter/bank/{reg_no}', [LetterController::class, 'bankLetter'])->name('plan.letter.bank');
            Route::get('letter/work-order/{reg_no}', [LetterController::class, 'workOrderLetter'])->name('plan.workOrdrer.letter');
            Route::get('letter/contract-letter/{reg_no}', [LetterController::class, 'contractLetter'])->name('plan.letter.contractLetter');
            Route::get('letter/advance-agreement-dashboard/{reg_no}', [LetterController::class, 'advanceAgreement'])->name('plan.letter.advance_agreement_dashboard');
            Route::get('letter/peski-account-letter/{reg_no}', [LetterController::class, 'peskiAccountLetter'])->name('plan.letter.peski_account_letter');
            Route::get('letter/advance-payment-letter/{reg_no}', [LetterController::class, 'advancePaymentLetter'])->name('plan.letter.advance_payment_letter');
            Route::get('letter/mandate-advance-agreement-letter/{reg_no}', [LetterController::class, 'mandateAdvanceAgreementLetter'])->name('plan.letter.mandateAdvanceAgreement');
            Route::get('letter/contract-extension-letter/{reg_no}', [LetterController::class, 'contractExtensionLetter'])->name('plan.letter.contractExtensionLetter');
            Route::post('letter/contract-extension-letter-submit', [LetterController::class, 'contractExtensionLetterSubmit'])->name('plan.letter.contractExtensionLetterSubmit');
            Route::get('letter/contract-extension-letter-2/{reg_no}', [LetterController::class, 'extensionLetter'])->name('plan.letter.extensionLetter');
            Route::post('letter/contract-extension-letter-2-submit', [LetterController::class, 'extensionLetterSubmit'])->name('plan.letter.extensionLetterSubmit');
            Route::get('letter/recommendation/{reg_no}', [LetterController::class, 'recommendationDashboard'])->name('plan.letter.recommendation');
            Route::get('letter/contract-letter-sifarish/{reg_no}',[LetterController::class,'contractSifarishLetter'])->name('plan.contract-sifarish-letter');
            Route::get('letter/mulyankan-bhuktani/{reg_no}',[LetterController::class,'mulyankanSifarisLetter'])->name('plan.letter.mulyankan_bhuktani');
            Route::get('print/letter/mulyankan-bhuktani',[LetterController::class,'printMulyankanSifarisLetter'])->name('plan.print.letter.mulyankan_bhuktani');
            Route::get('letter/final-payment-sifaris/{reg_no}',[LetterController::class,'finalPaymentSifaris'])->name('plan.letter.final_payment_sifaris');
            Route::get('print/letter/final-payment-sifaris',[LetterController::class,'printFinalPaymentSifaris'])->name('plan.print.letter.final_payment_sifaris');
            
            Route::get('print-letter/contract-extension-letter', [LetterController::class, 'printContractExtensionLetter'])->name('plan.letter.printContractExtensionLetter');
            Route::get('print-letter/contract-extension-letter-2', [LetterController::class, 'printExtensionLetter'])->name('plan.letter.printExtensionLetter');
            Route::get('print-letter/mandate-advance-agreement-letter', [LetterController::class, 'printMandateAdvanceAgreementLetter'])->name('plan.print.letter.mandateAdvanceAgreement');
            Route::get('print-letter/peski-account-letter', [LetterController::class, 'printPeskiAccountLetter'])->name('plan.print.letter.peski_account_letter');
            Route::get('print-letter/advance-payment-letter', [LetterController::class, 'printAdvancePaymentLetter'])->name('plan.print.letter.advance_payment_letter');
            Route::get('print-letter/contract', [LetterController::class, 'printTippaniContractLetter'])->name('letter.printContract');
            Route::get('print-letter/contract-letter', [LetterController::class, 'printContractLetter'])->name('plan.letter.printContract');
            Route::get('print-letter/bank', [LetterController::class, 'printBankLetter'])->name('plan.letter.printBank');
            Route::get('print-letter/work-order', [LetterController::class, 'printworkOrderLetter'])->name('plan.letter.printWorkOrder');
            Route::get('payment-letter/dashboard/{reg_no}', [LetterController::class, 'paymentLetterDashboard'])->name('plan.letter.paymentLetterDashboard');
            Route::get('final-payment-letter/tippani/{reg_no}', [LetterController::class, 'finalPaymentLetterTippani'])->name('plan.letter.payment_letter.tippani');
            Route::get('final-account-payment-letter/{reg_no}',[LetterController::class,'finalAccountPaymentLetter'])->name('plan.letter.final_account_payment_letter');
            Route::get('print-final-payment-letter/tippani', [LetterController::class, 'printFinalPaymentLetterTippani'])->name('plan.print.letter.payment_letter.tippani');
            Route::get('print-final-account-payment-letter',[LetterController::class,'printFinalAccountPaymentLetter'])->name('plan.print.letter.final_account_payment_letter');
            Route::get('print-letter-contract-sifarish',[LetterController::class,'printContractSifarishLetter'])->name('plan.letter.printContractSifarishLetter');
            // Running bill payment routes
            Route::get('running-bill-payment/{reg_no}', [RunningBillPaymentController::class, 'index'])->name('plan.running_bill_payment.index');
            Route::get('running-bill-payment-calculation', [RunningBillPaymentController::class, 'calculateRunningBill'])->name('plan.calculateRunningBill');
            Route::post('running-bill-payment', [RunningBillPaymentController::class, 'store'])->name('plan.running_bill_payment.store');
            
            // final payment route
            Route::get('final-payment/{reg_no}', [FinalPaymentController::class, 'index'])->name('plan.final_payment.index');
            Route::post('final-payment', [FinalPaymentController::class, 'store'])->name('plan.final_payment.store');
            Route::get('final-payment-delete/{reg_no}', [FinalPaymentController::class, 'delete'])->name('plan.final_payment.delete');


            // PESKI ROUTE
            Route::get('plan-bhuktani/{reg_no}', [AdvanceController::class, 'planDashboard'])->name('plan_bhuktani.dashboard');
            Route::get('plan/peski/bhuktani/{reg_no}', [AdvanceController::class, 'planPeskiBhuktani'])->name('plan.peski_bhuktani');
            Route::get('plan/peski/myad-thap/{reg_no}', [AdvanceController::class, 'planMyadThap'])->name('plan.antim_myad');
            Route::post('plan/peski/bhuktani', [AdvanceController::class, 'planPeskiBhuktaniStore'])->name('plan.peski_bhuktani_store');
            Route::put('plan/peski/bhuktani/{advance}', [AdvanceController::class, 'planPeskiBhuktaniUpdate'])->name('plan.peski_bhuktani_update');
            Route::post('plan/peski/myad-thap', [AdvanceController::class, 'planMyadThapStore'])->name('plan.antim_myad_store');
            Route::get('plan/peski/myad-thap-edit/{add_deadline}', [AdvanceController::class, 'planMyadThapEdit'])->name('plan.antim_myad_edit');
            Route::put('plan/peski/myad-thap-edit/{add_deadline}', [AdvanceController::class, 'planMyadThapUpdate'])->name('plan.antim_myad_update');
            // kul lagat route
            Route::get('/plan/kul-lagat/{reg_no}', [KulLagatController::class, 'index'])->name('plan.kul-lagat');
            Route::post('/kul-lagat', [KulLagatController::class, 'store'])->name('kul_lagat.store');
            Route::put('/kul-lagat/update/{kul_lagat}', [KulLagatController::class, 'update'])->name('kul_lagat.update');
            // type bibran route
            Route::get('/plan/type-bibaran/{reg_no}', [TypeController::class, 'index'])->name('plan.consumer-bibaran');
            Route::post('/plan/type-bibaran/store', [TypeController::class, 'store'])->name('type.store');
            Route::put('/plan/type-bibaran/update/{type}', [TypeController::class, 'update'])->name('type.update');
            // consumer bibaran
            Route::get('/plan/consumer-bibaran/{reg_no}', [ConsumerController::class, '\index'])->name('plan_consumer.index');
           Route::post('/plan/consumer-bibaran/store', [ConsumerController::class, 'store'])->name('plan_consumer.store');
            Route::put('/plan/consumer-bibaran/update/{consumer}', [ConsumerController::class, 'update'])->name('plan_consumer.update');
            // Sanstha samiti
            Route::get('/plan/sanstha_samiti/{reg_no}', [InstiutionalCommitteeController::class, 'index'])
                ->name('plan_sanstha.index');
            Route::post('/plan/sanstha_samiti', [InstiutionalCommitteeController::class, 'store'])
                ->name('plan_sanstha_samiti.store');
            Route::put('/plan/sanstha_samiti/{institutional_committee}', [InstiutionalCommitteeController::class, 'update'])
                ->name('plan_sanstha_samiti.update');
            // amanat marfat
            Route::get('/plan/amanat-marfat/{reg_no}', [AmanatController::class, 'index'])
                ->name('plan_amanat_marfat.index');
            Route::post('/plan/amanat-marfat', [AmanatController::class, 'store'])
                ->name('plan_amanat_marfat.store');
            Route::put('/plan/amanat-marfat/{amanat}', [AmanatController::class, 'update'])
                ->name('plan_amanat_marfat.update');
            //anugmana samiti bibran
            Route::get('/plan/anugaman-samiti/{reg_no}', [AnugamanSamitiController::class, 'showAnugmanBibaran'])
                ->name('plan.anugaman');
            Route::post('/plan/anugaman-samiti', [AnugamanSamitiController::class, 'storeAnugmanBibaran'])
                ->name('plan.anugaman_store');
            Route::put('/plan/anugaman-samiti/{anugaman_samiti}', [AnugamanSamitiController::class, 'updateAnugmanBibaran'])
                ->name('plan.anugaman_update');
            //yojana anya bibran
            Route::get('/plan/other-bibaran/{reg_no}', [OtherBibaranController::class, 'index'])
                ->name('plan.other_bibaran');
            Route::post('/plan/other-bibaran', [OtherBibaranController::class, 'store'])
                ->name('other-bibaran.store');
            Route::put('/plan/other-bibaran/{other_bibaran}', [OtherBibaranController::class, 'update'])
                ->name('other-bibaran.update');

            //Thekka marfat
            Route::get('/thekka-suchana-detail/{reg_no}', [ThekkaController::class,'thekkaSuchanaDetail'])->name('thekka-suchana-detail');
            Route::post('/thekka-suchana-detail-submit', [ThekkaController::class,'thekkaSuchanaDetailSubmit'])->name('thekka-suchana-detail-submit');
            
            Route::get('/thekka-open/{reg_no}', [ThekkaController::class,'thekkaOpenForm'])->name('thekka-open');
            Route::post('/thekka-open-submit',[ThekkaController::class,'thekkaOpenSubmit'])->name('thekka-open-submit');

            Route::get('thekka-kabol/{reg_no}',[ThekkaController::class,'thekkaKabol'])->name('thekka-kabol');
            Route::post('thekka-kabol-submit',[ThekkaController::class,'thekkaKabolSubmit'])->name('thekka-kabol-submit');
            
            Route::get('thekka-boli/{reg_no}',[ThekkaController::class,'thekkaboli'])->name('thekka-boli');
            Route::post('thekka-boli-submit',[ThekkaController::class,'thekkaBoliSubmit'])->name('thekka-boli-submit');

            Route::post('thekka-kul-lagat-submit',[ThekkaController::class,'thekkaKulLagatSubmit'])->name('thekka-kul-lagat-submit');

        });
    });
});
