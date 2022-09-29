<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\FinalPaymentRequest;
use App\Models\YojanaModel\add_deadline;
use App\Models\YojanaModel\advance;
use App\Models\YojanaModel\final_payment;
use App\Models\YojanaModel\final_payment_detail;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\running_bill_payment;
use App\Models\YojanaModel\setting\decimal_point;
use App\Models\YojanaModel\setting\deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FinalPaymentController extends Controller
{
    public function index($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $add_deadline = add_deadline::query()
            ->where('plan_id', $plan->id)
            ->latest()
            ->first();

        $latest_running_bill = running_bill_payment::query()
            ->where('plan_id', $plan->id)
            ->latest()
            ->first();

        $running_bills = running_bill_payment::query()
            ->where('plan_id', $plan->id)
            ->get();

        $final_payment = final_payment::query()
            ->where('plan_id', $plan->id)
            ->with('finalPaymentDeatils.Deduction')
            ->first();

        return view('yojana.Bhuktani.final_payment.final_payment', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'deductions' => deduction::query()->where('is_active', true)->get(),
            'plan_end_date_check' => $add_deadline == null ? $plan->otherBibaran->end_date : $add_deadline->period_add_date_nep,
            'plan_own_evaluation_amount_from_running_bill' => $latest_running_bill == null ? 0 : $latest_running_bill->plan_own_evaluation_amount,
            'advance' => advance::query()->where('plan_id', $plan->id)->first(),
            'sum_running_bill_payable_amount' => running_bill_payment::query()->where('plan_id', $plan->id)->sum('payable_amount'),
            'bhuktani_amount' => ($plan->kulLagat->napa_amount + $plan->kulLagat->other_office_con + $plan->kulLagat->other_office_agreement + $plan->kulLagat->customer_agreement) - ($running_bills->sum('payable_amount')),
            'decimal_point' => decimal_point::query()->where('fiscal_year_id', getCurrentFiscalYear(true)->id)->first(),
            'running_bill_payments' => $running_bills,
            'final_payment' => $final_payment
        ]);
    }

    public function store(FinalPaymentRequest $request, YojanaHelper $helper)
    {
        $deduction = [];
        DB::beginTransaction();
        try {
            $plan = plan::query()
                ->where('id', $request->plan_id)
                ->with('kulLagat', 'otherBibaran')
                ->first();

            $latest_running_bill = running_bill_payment::query()
                ->where('plan_id', $plan->id)
                ->latest()
                ->first();

            $running_bill_payment = running_bill_payment::query()->where('plan_id', $request->plan_id)->get();

            $data = $helper->calculateRunningBill($request->plan_id, $request->hal_mulyankan);

            $sum_of_contingency = $data['sum_of_contingency'] + ($running_bill_payment->count() ? 0 :  $request->advance_payment);
            if($request->has('deduction_percent')){
                foreach ($request->deduction_percent as $key => $deduction_percent) {
                    $deduction[$key] = $helper->getPreciseFloat((($deduction_percent * $data['napa_amount_without_contingency']) / 100), $data['decimal_point']);
                    $sum_of_contingency += $helper->getPreciseFloat((($deduction_percent * $data['napa_amount_without_contingency']) / 100), $data['decimal_point']);
                }
                
            }
            $final_total_paid_amount = $data['payable_amount'] - $sum_of_contingency;
            $final_payable_amount = ($plan->kulLagat->napa_amount + $plan->kulLagat->other_office_con + $plan->kulLagat->other_office_agreement + $plan->kulLagat->customer_agreement) - ($running_bill_payment->sum('payable_amount'));
            $plan_own_evaluation_amount_from_running_bill = $latest_running_bill == null ? 0 : $latest_running_bill->plan_own_evaluation_amount;
            $est_amount = $plan->kulLagat->total_investment;

            $final_payment = final_payment::create($request->except(
                'final_payable_amount',
                'payment_till_now',
                'ghati_mulyankan_amount',
                'total_bhuktani_amount',
                'final_contingency_amount',
                'final_total_amount_deducted',
                'final_total_paid_amount'
            ) + [
                'final_payable_amount' => $final_payable_amount,
                'payment_till_now' => $running_bill_payment->sum('payable_amount'),
                'ghati_mulyankan_amount' => ($est_amount - ($request->hal_mulyankan + $plan_own_evaluation_amount_from_running_bill)),
                'total_bhuktani_amount' => $data['payable_amount'],
                'final_contingency_amount' => $data['sum_of_contingency'],
                'final_total_amount_deducted' => $sum_of_contingency,
                'final_total_paid_amount' => $final_total_paid_amount,
                'fiscal_id' => getCurrentFiscalYear(true)->id,
                'ip' => $request->ip(),
                'type_id' => session('type_id'),
                'advance_payment' => $running_bill_payment->count() ? 0 : $request->advance_payment
            ]);
            if($request->has('deduction_percent')){
                foreach ($request->deduction_percent as $percentKey => $percent) {
                    final_payment_detail::create([
                        'plan_id' => $plan->id,
                        'final_payment_id' => $final_payment->id,
                        'deduction_id' => $percentKey,
                        'deduction_percent' => $percent,
                        'deduction_amount' => $deduction[$percentKey]
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Something went wrong...');
            // Alert::error($e->getMessage());
            return redirect()->back();
        }
        toast("मुल्यांकन को आधारमा भुक्तानी हाल्न सफल ", "success");
        return redirect()->back();
    }
    
    public function delete(Plan $reg_no)
    {
        dd($reg_no);
    }
}