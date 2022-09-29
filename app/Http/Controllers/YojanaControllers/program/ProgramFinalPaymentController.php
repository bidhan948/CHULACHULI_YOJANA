<?php

namespace App\Http\Controllers\YojanaControllers\program;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\ProgramFinalPaymentRequest;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\program\program_final_payment;
use App\Models\YojanaModel\program\program_payment_final_deduction;
use App\Models\YojanaModel\setting\deduction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramFinalPaymentController extends Controller
{
    public function index($reg_no): View
    {
        $program = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('workOrder')
            ->with('workOrder')
            ->first();

        if ($program == null) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }

        return view('yojana.program.bhuktani.program_final_payment', [
            'program' => $program,
            'reg_no' => $reg_no,
            'deductions' => deduction::query()->get(),
            'remain_amount' => ($program->grant_amount - $program->workOrder->sum('municipality_amount'))
        ]);
    }

    public function store(ProgramFinalPaymentRequest $request)
    {
        $deduction = [];
        DB::beginTransaction();
        try {
            $program_final_payment = program_final_payment::create($request->except('katti', 'is_final_payment')
                + ['fiscal_year_id' => getCurrentFiscalYear(true)->id, 'is_final_payment' => $request->has('is_final_payment') ? true : false]);

            foreach ($request->katti as $key => $deduction) {
                program_payment_final_deduction::create([
                    'program_final_payment_id' => $program_final_payment->id,
                    'deduction_id' => $key,
                    'amount' => $deduction
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            Alert::error('Something went wrong...');
            return redirect()->back();
        }
        toast("कार्यक्रमको अन्तिम भुक्तानी हाल्न सफल ", "success");
        return redirect()->back();
    }
}
