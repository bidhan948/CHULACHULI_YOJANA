<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffService;
use App\Models\SharedModel\bank;
use App\Models\YojanaModel\contractKabol;
use App\Models\YojanaModel\plan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContractLetterController extends Controller
{
    public function thekkaContractLetter($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->whereHas('contracts')
            ->with('otherBibaran', 'contracts')
            ->first();

        $contract_kabols = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->with('listRegistrationAttribute')
            ->get();

        if ($plan == null || !$contract_kabols->count()) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.letter.thekka.contract_tippani_letter', [
            'reg_no' => $reg_no,
            'plan' => $plan,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'contract_kabols' => $contract_kabols,
            'contract_kabol_single' => $contract_kabols->where('is_selected', 1)->first()
        ]);
    }

    public function printThekkaContractLetter(Request $request, $reg_no)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->whereHas('contracts')
            ->with('otherBibaran', 'contracts')
            ->first();

        $contract_kabols = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->with('listRegistrationAttribute')
            ->get();

        if ($plan == null || !$contract_kabols->count()) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();
        $sifarisPosition = StaffService::query()->where('user_id', $request->sifaris)->first();

        return view('yojana.letter.thekka.print_contract_tippani_letter', [
            'reg_no' => $request->plan_id,
            'plan' => $plan,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'sifaris' => staff::query()->where('user_id', $request->sifaris)->first(),
            'sifaris_post' => $sifarisPosition == null ? '' : getSettingValueById($sifarisPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'contract_kabols' => $contract_kabols,
            'contract_kabol_single' => $contract_kabols->where('is_selected', 1)->first(),
            'date' => $request->date_nep,
        ]);
    }

    public function bankLetter($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->whereHas('contracts')
            ->with('otherBibaran', 'contracts')
            ->first();

        $contract_kabols = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->with('listRegistrationAttribute.listRegistration')
            ->get();

        if ($plan == null || !$contract_kabols->count()) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.letter.thekka.bank_letter', [
            'reg_no' => $reg_no,
            'plan' => $plan,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'contract_kabols' => $contract_kabols,
            'contract_kabol_single' => $contract_kabols->where('is_selected', 1)->first(),
            'banks' => bank::query()->get()
        ]);
    }

    public function printBankLetter(Request $request)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->whereHas('contracts')
            ->with('otherBibaran', 'contracts')
            ->first();

        $contract_kabols = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->with('listRegistrationAttribute.listRegistration')
            ->get();

        if ($plan == null || !$contract_kabols->count()) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        if ($request->bank_id == '') {
            Alert::error(config('बैंक अनिवार्य छ'));
            return redirect()->back();
        }

        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.thekka.print_bank_letter', [
            'reg_no' => $request->plan_id,
            'plan' => $plan,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'contract_kabols' => $contract_kabols,
            'contract_kabol_single' => $contract_kabols->where('is_selected', 1)->first(),
            'date' => $request->date_nep,
            'bank' => bank::query()->where('id', $request->bank_id)->first()
        ]);
    }
}
