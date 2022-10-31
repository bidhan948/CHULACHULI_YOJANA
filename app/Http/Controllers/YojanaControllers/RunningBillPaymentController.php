<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\AddRunningBillPaymentRequest;
use App\Models\YojanaModel\advance;
use App\Models\YojanaModel\final_payment;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\running_bill_payment;
use App\Models\YojanaModel\running_bill_payment_detail;
use App\Models\YojanaModel\setting\contingency;
use App\Models\YojanaModel\setting\decimal_point;
use App\Models\YojanaModel\setting\deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RunningBillPaymentController extends Controller
{
    public function index($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->with('kulLagat')
            ->first();

        $running_bill_payment = running_bill_payment::query()
            ->with('runningBillPaymentDetails.Deduction')
            ->where('plan_id', $plan->id)
            ->get();

        $final_payment = final_payment::query()
            ->where('plan_id', $plan->id)
            ->first();

        return view('yojana.Bhuktani.add_running_bill_payment', [
            'plan' => $plan,
            'reg_no' => $reg_no,
            'deductions' => deduction::query()->where('is_active', true)->get(),
            'advance' => advance::query()->where('plan_id', $plan->id)->first(),
            'contingency' => contingency::query()->where('fiscal_year_id', getCurrentFiscalYear(true)->id)->first(),
            'paymentRatio' => $helper->paymentRatio($plan),
            'decimal_point' => decimal_point::query()->where('fiscal_year_id', getCurrentFiscalYear(true)->id)->first(),
            'running_bill_payments' => $running_bill_payment,
            'is_form' => $final_payment != null ? false : true
        ]);
    }

    public function store(AddRunningBillPaymentRequest $request, YojanaHelper $helper)
    {
        $deduction = [];
        DB::beginTransaction();
        try {

            $running_bill_payment = running_bill_payment::query()
                ->where('plan_id', $request->plan_id)
                ->get();

            $plan = plan::query()
                ->where('id', $request->plan_id)
                ->with('kulLagat')
                ->first();

            if (($request->payable_amount + $request->contingency_amount) < $plan->kulLagat->work_order_budget) {
                if ($request->is_auto_calculate) {
                    $data = $helper->calculateRunningBill($request->plan_id, $request->plan_evaluation_amount);

                    $sum_of_contingency = $data['sum_of_contingency'] + ($running_bill_payment->count() ? 0 :  $request->peski_amount);
                    foreach ($request->deduction_percent as $key => $deduction_percent) {
                        $deduction[$key] = $helper->getPreciseFloat((($deduction_percent * $data['napa_amount_without_contingency']) / 100), $data['decimal_point']);
                        $sum_of_contingency += $helper->getPreciseFloat((($deduction_percent * $data['napa_amount_without_contingency']) / 100), $data['decimal_point']);
                    }
                    $total_paid_amount = $data['payable_amount'] - $sum_of_contingency;

                    $running_bill_payment_check = running_bill_payment::insertOrIgnore($request->except(
                        'deduction_percent',
                        'deduction',
                        'plan_own_evaluation_amount',
                        'payable_amount',
                        'contingency_amount',
                        'total_katti_amount',
                        'total_paid_amount',
                        '_token'
                    ) + [
                        'period' => $running_bill_payment->count() + 1,
                        'ip' => $request->ip(),
                        'payable_amount' => $data['payable_amount'],
                        'total_katti_amount' => $sum_of_contingency,
                        'total_paid_amount' => $total_paid_amount,
                        'plan_own_evaluation_amount' => $request->plan_evaluation_amount + $running_bill_payment->sum('plan_evaluation_amount'),
                        'type_id' => session('type_id'),
                        'contingency_amount' => $data['sum_of_contingency']
                    ]);

                    if (!$running_bill_payment) {
                        Alert::error(config('YojanaMessage.CLIENT_ERROR'));
                        return redirect()->back();
                    }
                    $running_bill_payment_latest = running_bill_payment::query()->latest()->first();

                    foreach ($request->deduction_percent as $key => $percent) {
                        running_bill_payment_detail::create(
                            [
                                'plan_id' => $request->plan_id,
                                'running_bill_payment_id' => $running_bill_payment_latest->id,
                                'deduction_id' => $key,
                                'deduction_percent' => $percent,
                                'deduction_amount' => $deduction[$key],
                            ]
                        );
                    }
                } else {
                    $running_bill_payment_latest = running_bill_payment::create($request->except(
                        'deduction_percent',
                        'deduction',
                        'plan_own_evaluation_amount'
                    ) + [
                        'period' => $running_bill_payment->count() + 1,
                        'ip' => $request->ip(),
                        'plan_own_evaluation_amount' => $request->plan_evaluation_amount + $running_bill_payment->sum('plan_evaluation_amount'),
                        'type_id' => session('type_id')
                    ]);

                    foreach ($request->deduction_percent as $key => $percent) {
                        running_bill_payment_detail::create(
                            [
                                'plan_id' => $request->plan_id,
                                'running_bill_payment_id' => $running_bill_payment_latest->id,
                                'deduction_id' => $key,
                                'deduction_percent' => $percent,
                                'deduction_amount' => $request->deduction[$key],
                            ]
                        );
                    }
                }
                toast("मुल्यांकन को आधारमा भुक्तानी हाल्न सफल ", "success");
            } else {
                toast("हाल भुक्तानी दिने खुद रकम कार्यदेश रकम भन्दा बढी भयो | कृपया भुक्तानी दिनु पर्ने भए अन्तिम भुक्तानीमा जानुहोस", "error");
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Something went wrong...');
            return redirect()->back();
        }

        return redirect()->back();
    }

    /**
     * @return JSON to calculate running bill payment
     */
    public function calculateRunningBill(YojanaHelper $helper)
    {
        $data = $helper->calculateRunningBill(request('plan_id'), request('plan_evaluation_amount'));
        return response()->json($data);
    }
}
