<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\MyadThapRequest;
use App\Http\Requests\YojanaRequest\PeskiBhuktaniRequest;
use App\Models\YojanaModel\add_deadline;
use App\Models\YojanaModel\advance;
use App\Models\YojanaModel\contractKabol;
use App\Models\YojanaModel\final_payment;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\running_bill_payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdvanceController extends Controller
{
    public function planDashboard($reg_no): View
    {
        $plan =  plan::query()
            ->select('id', 'reg_no', 'name')
            ->where('reg_no', $reg_no)
            ->first();

        return view('yojana.Bhuktani.bhuktani_dashboard', [
            'reg_no' => $reg_no,
            'plan' => $plan
        ]);
    }

    public function planPeskiBhuktani($reg_no): View
    {
        $plan = plan::query()
            ->select('id', 'reg_no', 'name')
            ->where('reg_no', $reg_no)
            ->with('kulLagat')
            ->first();

        $advance = advance::query()
            ->where('plan_id', $plan->id)
            ->first();

        $running_bill_payment = running_bill_payment::query()
            ->where('plan_id', $plan->id)
            ->first();

        $final_payment = final_payment::query()
            ->where('plan_id', $plan->id)
            ->first();

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->first();

        return view('yojana.Bhuktani.peski_bhuktani', [
            'reg_no' => $reg_no,
            'plan' => $plan,
            'advance' => $advance,
            'show_form' => ($running_bill_payment == null ? ($final_payment == null ? false : true) : false),
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function planPeskiBhuktaniStore(PeskiBhuktaniRequest $request): RedirectResponse
    {
        advance::create($request->validated());
        toast('पेश्की भुक्तानी हाल्न सफल भयो', 'success');
        return redirect()->back();
    }

    public function planPeskiBhuktaniUpdate(PeskiBhuktaniRequest $request, advance $advance): RedirectResponse
    {
        $running_bill_payment = running_bill_payment::query()
            ->where('plan_id', $advance->plan_id)
            ->first();

        if ($running_bill_payment != null) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }

        $advance->update($request->validated());
        toast('पेश्की भुक्तानी सच्याउन सफल भयो', 'success');
        return redirect()->back();
    }

    public function planMyadThap($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->with('otherBibaran')
            ->first();

        return view('yojana.Bhuktani.mayd_thap', [
            'reg_no' => $reg_no,
            'plan' => $plan,
            'add_deadline' => add_deadline::query()
                ->where('plan_id', $plan->id)
                ->get()
        ]);
    }

    public function planMyadThapStore(MyadThapRequest $request): RedirectResponse
    {
        $add_deadline = add_deadline::query()
            ->where('plan_id', $request->plan_id)
            ->count();

        add_deadline::create($request->validated() + ['period' => $add_deadline + 1]);
        toast('म्याद थप्न सफल भयो', 'success');
        return redirect()->back();
    }

    public function planMyadThapEdit(add_deadline $add_deadline)
    {
        return view('yojana.Bhuktani.edit_myad_thap', [
            'add_deadline' => $add_deadline,
            'add_deadlines' => add_deadline::query()
                ->where('id', '!=', $add_deadline->id)
                ->get(),
            'plan' => plan::query()
                ->where('id', $add_deadline->plan_id)
                ->with('otherBibaran')
                ->first(),
            'reg_no' => $add_deadline->plan_id
        ]);
    }

    public function planMyadThapUpdate(MyadThapRequest $request, add_deadline $add_deadline): RedirectResponse
    {
        $add_deadline->update($request->validated());
        toast('म्याद सच्याउन सफल भयो', 'success');
        return redirect()->back();
    }
}
