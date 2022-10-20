<?php

namespace App\Http\Controllers;

use App\Http\Requests\YojanaRequest\ContractRequest;
use App\Http\Requests\YojanaRequest\ThekkaKabolRequest;
use App\Http\Requests\YojanaRequest\ThekkaOpenRequest;
use App\Models\PisModel\Staff;
use App\Models\YojanaModel\contract;
use App\Models\YojanaModel\contractKabol;
use App\Models\YojanaModel\contractOpen;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\list_registration;
use Illuminate\Http\Request;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use App\Models\YojanaModel\add_deadline;
use App\Models\YojanaModel\advance;
use App\Models\YojanaModel\contractKulLagat;
use App\Models\YojanaModel\final_payment;
use App\Models\YojanaModel\final_payment_detail;
use App\Models\YojanaModel\other_bibaran;
use App\Models\YojanaModel\running_bill_payment;
use App\Models\YojanaModel\running_bill_payment_detail;
use App\Models\YojanaModel\setting\contingency;
use App\Models\YojanaModel\setting\decimal_point;
use App\Models\YojanaModel\setting\deduction;
use Exception;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ThekkaController extends Controller
{

    public function thekkaSuchanaDetail(plan $reg_no)
    {
        $contract = contract::query()->where('plan_id', $reg_no->id)->first();
        return view('yojana.thekka.thekka_suchana_detail', ['plan' => $reg_no, 'contract' => $contract]);
    }

    public function thekkaSuchanaDetailSubmit(ContractRequest $request)
    {
        $contract = contract::query()->where('plan_id', $request->plan_id)->first();

        if ($contract == null) {
            contract::create($request->except('_token'));
            toast("ठेक्का सुचना विवरण हाल्न सफल भयो", 'success');
        } else {
            $contract->update($request->except('_token'));
            toast("ठेक्का सुचना विवरण सच्याउन सफल भयो", 'success');
        }
        return redirect()->back();
    }

    public function thekkaOpenForm($reg_no)
    {
        $plan = plan::query()->where('reg_no', $reg_no)->with('contractOpens')->first();

        if (count($plan->contractOpens) != 0) {
            return view('yojana.thekka.edit_thekka_open_form', ['plan' => $plan, 'list_registrations' => list_registration::query()->where('name', 'निर्माण व्यवसाय')->with('listRegistrationAttribute.listRegistrationAttributeDetails')->first()]);
        }
        return view('yojana.thekka.create_thekka_open_form', ['plan' => $plan, 'list_registrations' => list_registration::query()->where('name', 'निर्माण व्यवसाय')->with('listRegistrationAttribute.listRegistrationAttributeDetails')->first()]);
    }

    public function thekkaOpenSubmit(ThekkaOpenRequest $request)
    {
        contractOpen::query()->where('plan_id', $request->plan_id)->delete();

        foreach ($request->name as $key => $value) {
            contractOpen::create([
                'plan_id' => $request->plan_id,
                'name' => $request->name[$key],
                'bank_name' => $request->bank_name[$key],
                'list_registration_attribute_id' => $request->id[$key],
                'bank_guarantee_amount' => $request->bank_guarantee_amount[$key],
                'bank_date' => $request->bank_date[$key],
                'bail_amount' => $request->bail_amount[$key],
                'remark' => $request->remark[$key],
            ]);
        }
        toast("ठेक्का सुचना विवरण हाल्न सफल भयो", 'success');
        return redirect()->back();
        // contractOpen::create($re)
    }

    public function thekkaKabol($reg_no)
    {
        $plan = plan::query()->where('reg_no', $reg_no)->with('contractOpens')->first();

        $contractOpen = contractOpen::query()->where('plan_id', $plan->id)->get();
        $contractKabol = contractKabol::query()->where('plan_id', $plan->id)->get();

        if (count($contractOpen) == 0) {
            toast("ठेक्का सुचना विवरण हालिएको छैन", 'error');
            return redirect()->back();
        }

        if (count($contractKabol) > 0) {
            return view('yojana.thekka.edit_thekka_kabol', ['plan' => $plan, 'contract_open' => $contractOpen, 'contractKabol' => $contractKabol]);
        }
        return view('yojana.thekka.create_thekka_kabol', ['plan' => $plan, 'contract_open' => $contractOpen]);
    }

    public function thekkaKabolSubmit(ThekkaKabolRequest $request)
    {
        $contractKabol = contractKabol::query()->where('plan_id', $request->plan_id)->get();
        $plan = plan::query()->where('id', $request->plan_id)->first();
        if (count($contractKabol) > 0) {
            foreach ($contractKabol as $key => $value) {
                $value->delete();
            }
        }
        foreach ($request->contractor_name as $key => $value) {
            contractKabol::create([
                'plan_id' => $request->plan_id,
                'contractor_name' => $request->contractor_name[$key],
                'has_vat' => $request->has_vat[$key],
                'list_registration_attribute_id' => $request->list_registration_attribute_id[$key],
                'total_kabol_amount' => $request->total_kabol_amount[$key],
                'total_amount' => $request->total_amount[$key],
                'remark' => $request->remark[$key]
            ]);
        }
        toast("ठेक्का कबोल सुचना हाल्न सफल भयो", 'success');
        return redirect()->route('thekka-boli', ['reg_no' => $plan->reg_no]);
    }

    public function thekkaboli($reg_no)
    {
        $plan = plan::query()->where('reg_no', $reg_no)->with('contractOpens', 'contractKabols')->first();
        $contractKabol = contractKabol::query()->where(['plan_id' => $plan->id, 'is_selected' => true])->first();
        return view('yojana.thekka.create_thekka_bol', [
            'plan' => $plan,
            'contractKabol' => $contractKabol
        ]);
    }

    public function thekkaBoliSubmit(Request $request)
    {
        $request->validate([
            'kabol_id' => 'required',
            'date' => 'required'
        ]);
        $contractKabol = contractKabol::query()->where('id', $request->kabol_id)->with('plan', 'contract')->first();
        contractKabol::query()->where('plan_id', $request->plan_id)->update(
            ['is_selected' => false]
        );
        $contractKabol->update([
            'is_selected' => 1,
            'date' => $request->date
        ]);

        toast("निम्न ठेक्का " . $contractKabol->contractor_name . " हाल्न सफल भयो", "success");

        return redirect()->route('plan.thekka_kul_lagat', ['reg_no' => $contractKabol->plan->reg_no]);
    }

    public function thekkaKulalagat($reg_no)
    {
        $plan = plan::query()->where('reg_no', $reg_no)->first();
        $contractKabol = contractKabol::query()->where(['plan_id' => $plan->id, 'is_selected' => true])->first();
        $contract_kul_lagat = contractKulLagat::query()->where('plan_id', $plan->id)->first();

        if ($contractKabol == null) {
            Alert::error("ठेक्का खोलिने फारम भरिएको छैन");
            return redirect()->back();
        }

        $unit_id = Setting::query()->where('slug', 'setup_unit')->first();
        $units = SettingValue::query()->where('setting_id', $unit_id->id)->get();

        return view('yojana.thekka.thekka_kul_lagat', [
            'contract_kabol' => $contractKabol,
            'units' => $units,
            'contract_kul_lagat' => $contract_kul_lagat
        ]);
    }

    public function thekkaKulLagatSubmit(Request $request)
    {
        $plan = plan::query()->where('id', $request->plan_id)->first();

        $request->validate([
            'physical_amount' => 'required',
            'unit_id' => 'required'
        ]);

        $contract_kul_lagat = contractKulLagat::query()->where('plan_id', $plan->id)->first();

        if ($contract_kul_lagat == null) {
            contractKulLagat::create($request->except('_token'));
            toast("कुल लागत हाल्न सफल भयो", "success");
        } else {
            $contract_kul_lagat->update($request->only('physical_amount', 'unit_id'));
            toast("कुल लागत हाल्न सफल भयो", "success");
        }

        return redirect()->route('plan.thekka_bibaran', ['reg_no' => $plan->reg_no]);
    }

    public function thekkaBibaran($reg_no)
    {
        $plan = plan::query()->where('reg_no', $reg_no)->first();
        $contract_kul_lagat = contractKulLagat::query()->where('plan_id', $plan->id)->first();
        $contractKabol = contractKabol::query()->where(['plan_id' => $plan->id, 'is_selected' => true])->first();
        $other_bibaran = other_bibaran::query()->where('plan_id', $plan->id)->with('otherBibaranDetail')->first();

        if ($contract_kul_lagat == null || $contractKabol == null) {
            Alert::error("सम्पूर्ण फारम भरेर मात्र अगाडि बढ्नुहोला");
            return redirect()->back();
        }

        $view = $other_bibaran == null ? 'create' : 'edit';

        return view('yojana.thekka.' . $view . '_thekka_run_detail', [
            'plan' => $plan,
            'reg_no' => $reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'contract_kabol' => $contractKabol,
            'other_bibaran' => $other_bibaran
        ]);
    }

    public function runningBillPayment($reg_no)
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

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();
        return view('yojana.thekka.add_running_bill_payment', [
            'plan' => $plan,
            'reg_no' => $reg_no,
            'deductions' => deduction::query()->where('is_active', true)->get(),
            'advance' => advance::query()->where('plan_id', $plan->id)->first(),
            'contingency' => contingency::query()->where('fiscal_year_id', getCurrentFiscalYear(true)->id)->first(),
            'decimal_point' => decimal_point::query()->where('fiscal_year_id', getCurrentFiscalYear(true)->id)->first(),
            'running_bill_payments' => $running_bill_payment,
            'is_form' => $final_payment != null ? false : true,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function runningBillPaymentStore(Request $request)
    {
        DB::beginTransaction();

        try {
            $running_bill_payment = running_bill_payment::query()
                ->where('plan_id', $request->plan_id)
                ->get();

            $plan = plan::query()
                ->where('id', $request->plan_id)
                ->with('kulLagat')
                ->first();
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

            foreach ($request->deduction as $key => $amount) {
                running_bill_payment_detail::create(
                    [
                        'plan_id' => $request->plan_id,
                        'running_bill_payment_id' => $running_bill_payment_latest->id,
                        'deduction_id' => $key,
                        'deduction_amount' => $amount,
                    ]
                );
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error($e->getMessage());
            return redirect()->back();
        }
        toast("मुल्यांकन को आधारमा भुक्तानी हाल्न सफल ", "success");
        return redirect()->back();
    }

    public function finalPayment($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('otherBibaran')
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

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();
        return view('yojana.thekka.final_payment', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'deductions' => deduction::query()->where('is_active', true)->get(),
            'plan_end_date_check' => $add_deadline == null ? $plan->otherBibaran->end_date : $add_deadline->period_add_date_nep,
            'plan_own_evaluation_amount_from_running_bill' => $latest_running_bill == null ? 0 : $latest_running_bill->plan_own_evaluation_amount,
            'advance' => advance::query()->where('plan_id', $plan->id)->first(),
            'sum_running_bill_payable_amount' => running_bill_payment::query()->where('plan_id', $plan->id)->sum('payable_amount'),
            'bhuktani_amount' => ($contract_kabol->total_amount) - ($running_bills->sum('payable_amount')),
            'decimal_point' => decimal_point::query()->where('fiscal_year_id', getCurrentFiscalYear(true)->id)->first(),
            'running_bill_payments' => $running_bills,
            'final_payment' => $final_payment,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function finalPaymentStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $plan = plan::query()
                ->where('id', $request->plan_id)
                ->with('kulLagat', 'otherBibaran')
                ->first();

            $running_bill_payment = running_bill_payment::query()->where('plan_id', $request->plan_id)->get();

            $final_payment = final_payment::create($request->all() + [
                'fiscal_id' => getCurrentFiscalYear(true)->id,
                'ip' => $request->ip(),
                'type_id' => session('type_id'),
                'advance_payment' => $running_bill_payment->count() ? 0 : $request->advance_payment
            ]);

            if ($request->has('deduction')) {
                foreach ($request->deduction as $key => $deduction) {
                    final_payment_detail::create([
                        'plan_id' => $plan->id,
                        'final_payment_id' => $final_payment->id,
                        'deduction_id' => $key,
                        'deduction_amount' => $deduction
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Alert::error('Something went wrong...');
            Alert::error($e->getMessage());
            return redirect()->back();
        }
        toast("मुल्यांकन को आधारमा भुक्तानी हाल्न सफल ", "success");
        return redirect()->back();
    }
}
