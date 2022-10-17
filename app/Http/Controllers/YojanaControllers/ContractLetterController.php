<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\PisModel\Staff;
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
        ->get();

        if ($plan == null || !$contract_kabols->count()) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.letter.thekka.contract_tippani_letter', [
            'reg_no' => $reg_no,
            'plan' => $plan,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'contract_kabols' => $contract_kabols
        ]);
    }
}
