<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffService;
use App\Models\SharedModel\bank;
use App\Models\YojanaModel\add_deadline;
use App\Models\YojanaModel\advance;
use App\Models\YojanaModel\anugaman_plan;
use App\Models\YojanaModel\contractKabol;
use App\Models\YojanaModel\final_payment;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\running_bill_payment;
use App\Models\YojanaModel\setting\term;
use App\Models\YojanaModel\type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LetterController extends Controller
{
    public function index($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));

            return redirect()->back();
        }

        return view('yojana.letter.dashboard', [
            'reg_no' => $plan->reg_no,
            'plan' => $plan
        ]);
    }

    public function contractTippaniLetter($reg_no, YojanaHelper $helper)
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

        return view('yojana.letter.contract_letter', [
            'reg_no' => $reg_no,
            'plan' => $plan,
            'type' => type::query()->where('plan_id', $plan->id)->first(),
            'contingency_sum' => ($helper->sumOfContingencyAmount($plan->id))->sum(),
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get()
        ]);
    }

    public function printTippaniContractLetter(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();


        return view('yojana.letter.contract_print_letter', [
            'reg_no' => $request->plan_id,
            'plan' => $plan,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'type' => type::query()->where('plan_id', $plan->id)->first(),
            'contingency_sum' => ($helper->sumOfContingencyAmount($plan->id))->sum(),
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get()
        ]);
    }

    public function bankLetter($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->first();
        $post = [];

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }
        $type = type::query()->where('plan_id', $plan->id)->first();
        $relationName = $helper->getRelationNameViaSession(session('type_id'));
        $type_details = $type->typeable->load($relationName);

        $adakshya = $type_details->$relationName->count() ? $type_details->$relationName->where('post_id', config('constant.TOLE_ADAKSHYA_ID'))->first() : null;

        if ($adakshya != null) {
            $post[] = $adakshya->name;
        }

        $sachib_name = $type_details->$relationName->count() ? $type_details->$relationName->where('post_id', config('constant.TOLE_SACHIB_ID'))->first() : null;

        if ($sachib_name != null) {
            $post[] = $sachib_name->name;
        }

        $kosadakshya_name = $type_details->$relationName->count() ? $type_details->$relationName->where('post_id', config('constant.TOLE_KOSADAKSHYA_ID'))->first() : null;

        if ($kosadakshya_name != null) {
            $post[] = $kosadakshya_name->name;
        }

        return view('yojana.letter.bank_letter', [
            'plan' => $plan,
            'reg_no' => $reg_no,
            'type' => $type,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'banks' => bank::query()->get(),
            'adakshya_name' => $adakshya,
            'sachib_name' => $sachib_name,
            'kosadakshya_name' => $kosadakshya_name,
            'post' => $post
        ]);
    }

    public function printBankLetter(Request $request)
    {
        $request->validate(
            [
                'date_nep' => 'required',
                'bank_id' => 'required',
                'approve' => 'required'
            ]
        );

        $plan = plan::query()
            ->where('reg_no', $request->plan_id)
            ->whereHas('otherBibaran')
            ->first();
        $post = [];

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }
        $type = type::query()->where('plan_id', $plan->id)->first();
        $type_details = $type->typeable->load('consumerDetails');

        $adakshya = $type_details->consumerDetails->count() ? $type_details->consumerDetails->where('post_id', config('constant.TOLE_ADAKSHYA_ID'))->first() : null;

        if ($adakshya != null) {
            $post[] = $adakshya->name;
        }

        $sachib_name = $type_details->consumerDetails->count() ? $type_details->consumerDetails->where('post_id', config('constant.TOLE_SACHIB_ID'))->first() : null;

        if ($sachib_name != null) {
            $post[] = $sachib_name->name;
        }

        $kosadakshya_name = $type_details->consumerDetails->count() ? $type_details->consumerDetails->where('post_id', config('constant.TOLE_KOSADAKSHYA_ID'))->first() : null;

        if ($kosadakshya_name != null) {
            $post[] = $kosadakshya_name->name;
        }

        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();


        return view('yojana.letter.print_bank_letter', [
            'plan' => $plan,
            'reg_no' => $request->plan_id,
            'type' => $type,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'bank' => bank::query()->where('id', $request->bank_id)->first(),
            'adakshya_name' => $adakshya,
            'sachib_name' => $sachib_name,
            'kosadakshya_name' => $kosadakshya_name,
            'post' => $post,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'date' => $request->date_nep
        ]);
    }

    public function workOrderLetter($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran', 'planWardDetails')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.letter.plan_work_order_letter', [
            'reg_no' => $reg_no,
            'plan' => $plan,
            'type' => type::query()->where('plan_id', $plan->id)->first(),
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'contingency_sum' => ($helper->sumOfContingencyAmount($plan->id))->sum()
        ]);
    }

    public function printworkOrderLetter(Request $request, YojanaHelper $helper)
    {
        $request->validate(['date_nep' => 'required', 'approve' => 'required']);
        $plan = plan::query()
            ->where('reg_no', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran', 'planWardDetails')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.print_plan_work_order_letter', [
            'reg_no' => $plan->reg_no,
            'plan' => $plan,
            'type' => type::query()->where('plan_id', $plan->id)->first(),
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'contingency_sum' => ($helper->sumOfContingencyAmount($plan->id))->sum(),
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'engineer' => staff::query()->where('user_id', $request->engineer_id)->first() ? staff::query()->where('user_id', $request->engineer_id)->first() : '',
            'date' => $request->date_nep
        ]);
    }

    public function contractLetter($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran.otherBibaranDetail.Staff', 'otherBibaran.otherBibaranDetail.staffServices', 'planWardDetails')
            ->with('otherBibaran.otherBibaranDetail', function ($q) {
                $q->orderBy('id', 'asc');
            })
            ->first();


        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $anugamanPlan = anugaman_plan::query()
            ->with('anugamanSamiti.anugamanSamitiDetails')
            ->where('plan_id', $reg_no)
            ->where('type_id', session('type_id'))
            ->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));

        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }
        return view('yojana.letter.letter_contract_letter', [
            'reg_no' => $reg_no,
            'plan' => $plan,
            'type' => $type,
            'type_details' => $details->$relationName ?? [],
            'contingency_sum' => ($helper->sumOfContingencyAmount($plan->id))->sum(),
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'term' => term::query()->where('type_id', session('type_id'))->first(),
            'htmlTypeTableRow' => $htmlTypeTableRow ?? '',
            'anugamanPlan' => $anugamanPlan
        ]);
    }

    public function printContractLetter(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('reg_no', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran.otherBibaranDetail.Staff', 'otherBibaran.otherBibaranDetail.staffServices', 'planWardDetails')
            ->with('otherBibaran.otherBibaranDetail', function ($q) {
                $q->orderBy('id', 'asc');
            })
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));

        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        $anugamanPlan = anugaman_plan::query()
            ->with('anugamanSamiti.anugamanSamitiDetails')
            ->where('plan_id', $plan->id)
            ->where('type_id', session('type_id'))
            ->first();

        return view('yojana.letter.print_letter_contract_letter', [
            'reg_no' => $request->plan_id,
            'plan' => $plan,
            'type' => $type,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'type_details' => $details->$relationName ?? [],
            'contingency_sum' => ($helper->sumOfContingencyAmount($plan->id))->sum(),
            'term' => term::query()->where('type_id', session('type_id'))->first(),
            'htmlTypeTableRow' => $htmlTypeTableRow ?? '',
            'anugamanPlan' => $anugamanPlan
        ]);
    }

    public function advanceAgreement($reg_no)
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

        return view('yojana.letter.advance_agreement.dashboard', [
            'plan' => $plan,
            'reg_no' => $reg_no
        ]);
    }

    public function advancePaymentLetter($reg_no, YojanaHelper $helper)
    {

        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('otherBibaran')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }
        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $advance = advance::query()->where('plan_id', $plan->id)->first();

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();

        return view('yojana.letter.advance_agreement.advance_payment_letter', [
            'plan' => $plan,
            'reg_no' => $reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'relationName' => $relationName,
            'details' => $details ?? [],
            'type' => $type,
            'advance' => $advance,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function printAdvancePaymentLetter(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('otherBibaran')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $advance = advance::query()->where('plan_id', $plan->id)->first();

        if ($advance == null) {
            Alert::error(config('YojanaMessage.PESKI_INCOMPLETE_FORM_MSG'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.advance_agreement.print_advance_payment_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'relationName' => $relationName,
            'details' => $details ?? [],
            'type' => $type,
            'advance' => $advance,
            'date' => $request->date_nep,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function peskiAccountLetter($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('otherBibaran', 'budgetSourcePlanDetails.budgetSources')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $advance = advance::query()->where('plan_id', $plan->id)->first();

        if ($advance == null) {
            Alert::error(config('YojanaMessage.PESKI_INCOMPLETE_FORM_MSG'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        return view('yojana.letter.advance_agreement.account_letter', [
            'plan' => $plan,
            'reg_no' => $reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'advance' => $advance,
            'details' => $details ?? [],
            'type' => $type,
        ]);
    }

    public function printPeskiAccountLetter(Request $request, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('otherBibaran', 'budgetSourcePlanDetails.budgetSources')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $advance = advance::query()->where('plan_id', $plan->id)->first();

        if ($advance == null) {
            Alert::error(config('YojanaMessage.PESKI_INCOMPLETE_FORM_MSG'));
            return redirect()->back();
        }

        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.advance_agreement.print_account_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'advance' => $advance,
            'details' => $details ?? [],
            'type' => $type,
            'date' => $request->date_nep
        ]);
    }

    public function mandateAdvanceAgreementLetter($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('otherBibaran', 'budgetSourcePlanDetails.budgetSources')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $advance = advance::query()->where('plan_id', $plan->id)->first();

        if ($advance == null) {
            Alert::error(config('YojanaMessage.PESKI_INCOMPLETE_FORM_MSG'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        return view('yojana.letter.mandate_advance_agreement_letter', [
            'plan' => $plan,
            'reg_no' => $reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'advance' => $advance,
            'details' => $details ?? [],
            'type' => $type,
        ]);
    }

    public function printMandateAdvanceAgreementLetter(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('otherBibaran', 'budgetSourcePlanDetails.budgetSources')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $advance = advance::query()->where('plan_id', $plan->id)->first();

        if ($advance == null) {
            Alert::error(config('YojanaMessage.PESKI_INCOMPLETE_FORM_MSG'));
            return redirect()->back();
        }

        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.print_mandate_advance_agreement_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'advance' => $advance,
            'details' => $details ?? [],
            'type' => $type,
            'date' => $request->date_nep
        ]);
    }

    public function contractExtensionLetter($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->first();

        $add_deadlines = add_deadline::query()->where('plan_id', $plan->id)->get();

        if ($plan == null || !$add_deadlines->count()) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.letter.contract_extension.dashboard', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'add_deadlines' => $add_deadlines,
        ]);
    }

    public function contractExtensionLetterSubmit(Request $request)
    {
        if ($request->add_deadline_id == '') {
            Alert::error("पत्र छान्नुहोस्");
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('otherBibaran')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        $add_deadline = add_deadline::query()->where('id', $request->add_deadline_id)->first();

        if ($plan == null || $add_deadline == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();

        return view('yojana.letter.contract_extension.contract_extension_letter', [
            'add_deadline' => $add_deadline,
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function printContractExtensionLetter(Request $request)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        if ($request->add_deadline_id == '') {
            Alert::error("पत्र छान्नुहोस्");
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('otherBibaran')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        $add_deadline = add_deadline::query()->where('id', $request->add_deadline_id)->first();

        if ($plan == null || $add_deadline == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }
        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();
        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.contract_extension.print_contract_extension_letter', [
            'add_deadline' => $add_deadline,
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function extensionLetter($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $add_deadlines = add_deadline::query()->where('plan_id', $plan->id)->get();

        return view('yojana.letter.contract_extension.dashboard_extension_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'add_deadlines' => $add_deadlines,
        ]);
    }

    public function extensionLetterSubmit(Request $request, YojanaHelper $helper)
    {
        if ($request->add_deadline_id == '') {
            Alert::error("पत्र छान्नुहोस्");
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('otherBibaran')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        $add_deadline = add_deadline::query()->where('id', $request->add_deadline_id)->first();

        if ($plan == null || $add_deadline == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();

        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        return view('yojana.letter.contract_extension.extension_letter', [
            'add_deadline' => $add_deadline,
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'details' => $details ?? [],
            'type' => $type,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function printExtensionLetter(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('otherBibaran')
            ->with('planWardDetails', function ($query) {
                $query->orderBy('ward_no');
            })
            ->first();

        $add_deadline = add_deadline::query()->where('id', $request->add_deadline_id)->first();

        if ($plan == null || $add_deadline == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();
        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        if ($plan == null || $add_deadline == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));

        if ($relationName != '') {
            $details = $type->typeable->load($relationName);
        }
        return view('yojana.letter.contract_extension.print_extension_letter', [
            'add_deadline' => $add_deadline,
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'details' => $details ?? [],
            'type' => $type,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function runningBillPaymentLetterDashboard($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->whereHas('runningBillPayment')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            //return redirect()->route('letter.dashboard', ['reg_no' => $reg_no]);
            return redirect()->back();
        }
        return view('yojana.letter.running_bill_payment.running_bill_payment_dashboard', [
            'plan' => $plan,
            'reg_no' => $reg_no
        ]);
    }

    public function runningBillPaymentLetter($reg_no, $route = "")
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->whereHas('runningBillPayment')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.letter.running_bill_payment.running_bill_payement_search', [
            'plan' => $plan,
            'reg_no' => $reg_no,
            'route' => 'plan.letter.' . $route,
            'running_bill_payments' => running_bill_payment::query()->where('plan_id', $plan->id)->get()
        ]);
    }

    public function runningBillPaymentLetterSubmit(Request $request, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->whereHas('runningBillPayment')
            ->with('runningBillPayment', 'kulLagat', 'otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }
        if ($request->running_bill_payment_id == '') {
            Alert::error(config('YojanaMessage.REQUIRED_RUNNING_BILL_PAYMENT_MESSAGE'));
            return redirect()->back();
        }

        $running_bill_payment = running_bill_payment::query()->where('id', $request->running_bill_payment_id)->first();

        if ($running_bill_payment == null) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }
        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));

        if ($relationName != '') {
            $details = $type->typeable->load($relationName);
        }

        $bank = bank::all();
        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();

        return view('yojana.letter.running_bill_payment.running_bill_payment_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'running_bill_payment' =>  $running_bill_payment,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'details' => $details ?? [],
            'type' => $type,
            'bank' => $bank,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function printRunningBillPaymentLetter(Request $request, YojanaHelper $helper)
    {
        // dd($request->all());
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->whereHas('runningBillPayment')
            ->with('runningBillPayment', 'kulLagat', 'otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }
        $running_bill_payment = running_bill_payment::query()->where('id', $request->running_bill_payment_id)->first();

        if ($running_bill_payment == null) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }
        $bank = Bank::query()->where('id', $request->bank_id)->first();

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();

        return view('yojana.letter.running_bill_payment.print_running_bill_payment_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'details' => $details ?? [],
            'type' => $type,
            'bank' => $bank,
            'acc_no' => $request->acc_no,
            'running_bill_payment' =>  $running_bill_payment,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function accountPaymentLetterSubmit(Request $request, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->whereHas('runningBillPayment')
            ->with('runningBillPayment', 'kulLagat', 'otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }
        if ($request->running_bill_payment_id == '') {
            Alert::error(config('YojanaMessage.REQUIRED_RUNNING_BILL_PAYMENT_MESSAGE'));
            return redirect()->back();
        }

        $running_bill_payment = running_bill_payment::query()->where('id', $request->running_bill_payment_id)->first();

        if ($running_bill_payment == null) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }
        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();

        return view('yojana.letter.running_bill_payment.account_payment_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'running_bill_payment' =>  $running_bill_payment,
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'details' => $details ?? [],
            'type' => $type,
            'contract_kabol' => $contract_kabol,
            'bank' => bank::query()->get()
        ]);
    }

    public function printAccountPaymentLetter(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->whereHas('otherBibaran')
            ->whereHas('runningBillPayment')
            ->with('runningBillPayment', 'kulLagat', 'otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }
        $running_bill_payment = running_bill_payment::query()->where('id', $request->running_bill_payment_id)->first();

        if ($running_bill_payment == null) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }
        $contract_kabol = contractKabol::query()
            ->where('plan_id', $plan->id)
            ->where('is_selected', 1)
            ->with('listRegistrationAttribute.listRegistration')
            ->first();
        return view('yojana.letter.running_bill_payment.print_account_payment_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'details' => $details ?? [],
            'type' => $type,
            'running_bill_payment' =>  $running_bill_payment,
            'bank' => bank::query()->where('id', $request->bank_id)->first(),
            'acc_no' => $request->acc_no,
            'contract_kabol' => $contract_kabol
        ]);
    }

    public function paymentLetterDashboard($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->whereHas('finalPayment')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.letter.payment-letter.payment_dashboard', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no
        ]);
    }

    public function finalPaymentLetterTippani($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->whereHas('finalPayment')
            ->with('kulLagat', 'otherBibaran', 'budgetSourcePlanDetails.budgetSources', 'planAllocation', 'planWardDetails')
            ->first();

        $bank = bank::all();

        $add_deadline = add_deadline::query()
            ->where('plan_id', $plan->id)
            ->latest()
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $final_payment = final_payment::query()
            ->where('plan_id', $plan->id)
            ->with('finalPaymentDeatils.Deduction')
            ->first();

        $type = type::query()->where('plan_id', $plan->id)->first();
        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        return view('yojana.letter.payment-letter.final_tippani_letter', [
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'plan' => $plan,
            'reg_no' => $reg_no,
            'final_payment' => $final_payment,
            'details' => $details ?? [],
            'type' => $type,
            'add_deadline' => $add_deadline,
            'bank' => $bank
        ]);
    }

    public function printFinalPaymentLetterTippani(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('reg_no', $request->plan_id)
            ->whereHas('otherBibaran')
            ->whereHas('finalPayment')
            ->with('kulLagat', 'otherBibaran', 'budgetSourcePlanDetails.budgetSources', 'planAllocation')
            ->first();
        $bank = bank::query()->where('id', $request->bank_id)->first();

        $add_deadline = add_deadline::query()
            ->where('plan_id', $plan->id)
            ->latest()
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $final_payment = final_payment::query()
            ->where('plan_id', $plan->id)
            ->with('finalPaymentDeatils.Deduction')
            ->first();

        $type = type::query()->where('plan_id', $plan->id)->first();
        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.payment-letter.print_final_payment_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'details' => $details ?? [],
            'type' => $type,
            'final_payment' => $final_payment,
            'add_deadline' => $add_deadline,
            'bank' => $bank,
            'acc_no' => $request->acc_no,
            'bhuktani_name' => $request->bhuktani_name
        ]);
    }

    public function finalAccountPaymentLetter($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->whereHas('finalPayment')
            ->with('kulLagat', 'otherBibaran', 'budgetSourcePlanDetails.budgetSources', 'planAllocation')
            ->first();

        $bank = bank::all();

        $add_deadline = add_deadline::query()
            ->where('plan_id', $plan->id)
            ->latest()
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $final_payment = final_payment::query()
            ->where('plan_id', $plan->id)
            ->with('finalPaymentDeatils.Deduction')
            ->first();

        $type = type::query()->where('plan_id', $plan->id)->first();
        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        return view('yojana.letter.payment-letter.final_account_payment_letter', [
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'plan' => $plan,
            'reg_no' => $reg_no,
            'final_payment' => $final_payment,
            'details' => $details ?? [],
            'type' => $type,
            'add_deadline' => $add_deadline,
            'bank' => $bank
        ]);
    }

    public function printFinalAccountPaymentLetter(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('reg_no', $request->plan_id)
            ->whereHas('otherBibaran')
            ->whereHas('finalPayment')
            ->with('kulLagat', 'otherBibaran')
            ->first();
        $bank = bank::query()->where('id', $request->bank_id)->first();

        $add_deadline = add_deadline::query()
            ->where('plan_id', $plan->id)
            ->latest()
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $final_payment = final_payment::query()
            ->where('plan_id', $plan->id)
            ->with('finalPaymentDeatils.Deduction')
            ->first();

        $type = type::query()->where('plan_id', $plan->id)->first();
        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.payment-letter.print_final_account_payment_letter', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'details' => $details ?? [],
            'type' => $type,
            'final_payment' => $final_payment,
            'add_deadline' => $add_deadline,
            'bank' => $bank,
            'acc_no' => $request->acc_no,
            'bhuktani_name' => $request->bhuktani_name
        ]);
    }

    public function contractSifarishLetter($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran.otherBibaranDetail.Staff', 'otherBibaran.otherBibaranDetail.staffServices', 'planWardDetails')
            ->with('otherBibaran.otherBibaranDetail', function ($q) {
                $q->orderBy('id', 'asc');
            })
            ->first();



        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $anugamanPlan = anugaman_plan::query()
            ->with('anugamanSamiti.anugamanSamitiDetails')
            ->where('plan_id', $reg_no)
            ->where('type_id', session('type_id'))
            ->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));

        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }
        return view('yojana.letter.contract_letter_sifarish', [
            'reg_no' => $reg_no,
            'plan' => $plan,
            'type' => $type,
            'type_details' => $details->$relationName ?? [],
            'contingency_sum' => ($helper->sumOfContingencyAmount($plan->id))->sum(),
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'term' => term::query()->where('type_id', session('type_id'))->first(),
            'htmlTypeTableRow' => $htmlTypeTableRow ?? '',
            'anugamanPlan' => $anugamanPlan
        ]);

        // return view('yojana.letter.contract_letter_sifarish', [
        //     'reg_no' => $reg_no,
        //     'plan' => $plan,
        //     'type' => $type,
        //     'type_details' => $details->$relationName ?? [],
        //     'contingency_sum' => ($helper->sumOfContingencyAmount($plan->id))->sum(),
        //     'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
        //     'term' => term::query()->where('type_id', session('type_id'))->first(),
        //     'htmlTypeTableRow' => $htmlTypeTableRow ?? '',
        //     'anugamanPlan' => $anugamanPlan
        // ]);
    }

    public function printContractSifarishLetter(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('reg_no', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran.otherBibaranDetail.Staff', 'otherBibaran.otherBibaranDetail.staffServices', 'planWardDetails')
            ->with('otherBibaran.otherBibaranDetail', function ($q) {
                $q->orderBy('id', 'asc');
            })
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();

        $relationName = $helper->getRelationNameViaSession(session('type_id'));

        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        $anugamanPlan = anugaman_plan::query()
            ->with('anugamanSamiti.anugamanSamitiDetails')
            ->where('plan_id', $plan->id)
            ->where('type_id', session('type_id'))
            ->first();

        return view('yojana.letter.print_letter_contract_sifarish_letter', [
            'reg_no' => $request->plan_id,
            'plan' => $plan,
            'type' => $type,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'type_details' => $details->$relationName ?? [],
            'contingency_sum' => ($helper->sumOfContingencyAmount($plan->id))->sum(),
            'term' => term::query()->where('type_id', session('type_id'))->first(),
            'htmlTypeTableRow' => $htmlTypeTableRow ?? '',
            'anugamanPlan' => $anugamanPlan
        ]);
    }

    public function recommendationDashboard($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->first();

        return view('yojana.letter.sifaris.dashboard', [
            'reg_no' => $plan->reg_no,
            'plan' => $plan,
        ]);
    }

    public function mulyankanSifarisLetter($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran', 'budgetSourcePlanDetails.budgetSources', 'planAllocation')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();
        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        return view('yojana.letter.sifaris.mulyankan_sifaris', [
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'plan' => $plan,
            'reg_no' => $reg_no,
            'details' => $details ?? [],
            'type' => $type
        ]);
    }

    public function printMulyankanSifarisLetter(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('reg_no', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();
        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.sifaris.print_mulyankan_sifaris', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'details' => $details ?? [],
            'type' => $type,
        ]);
    }

    public function finalPaymentSifaris($reg_no, YojanaHelper $helper)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran', 'budgetSourcePlanDetails.budgetSources', 'planAllocation')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();
        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        return view('yojana.letter.sifaris.antim_sifaris', [
            'staffs' => Staff::query()->select('id', 'user_id', 'nep_name')->get(),
            'plan' => $plan,
            'reg_no' => $reg_no,
            'details' => $details ?? [],
            'type' => $type
        ]);
    }

    public function printFinalPaymentSifaris(Request $request, YojanaHelper $helper)
    {
        if ($request->date_nep == '') {
            toast('मिति अनिवार्य छ', 'error');
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('reg_no', $request->plan_id)
            ->whereHas('otherBibaran')
            ->with('kulLagat', 'otherBibaran')
            ->first();

        if ($plan == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $type = type::query()->where('plan_id', $plan->id)->first();
        $relationName = $helper->getRelationNameViaSession(session('type_id'));


        if ($relationName != '') {
            $details = $type->typeable_type::query()
                ->where('id', $type->typeable_id)
                ->with($relationName, function ($q) {
                    $q->orderBy('id');
                })
                ->first();
            $htmlTypeTableRow = $helper->getTableRowOfTypePost($details->$relationName);
        }

        $readyPosition = StaffService::query()->where('user_id', $request->ready)->first();
        $presentPosition = StaffService::query()->where('user_id', $request->present)->first();
        $approvePosition = StaffService::query()->where('user_id', $request->approve)->first();

        return view('yojana.letter.sifaris.print_antim_sifaris', [
            'plan' => $plan,
            'reg_no' => $plan->reg_no,
            'date' => $request->date_nep,
            'ready' => staff::query()->where('user_id', $request->ready)->first(),
            'ready_post' => $readyPosition == null ? '' : getSettingValueById($readyPosition->position)->name,
            'present' =>  staff::query()->where('user_id', $request->present)->first(),
            'present_post' => $presentPosition == null ? '' : getSettingValueById($presentPosition->position)->name,
            'approve' => staff::query()->where('user_id', $request->approve)->first(),
            'approve_post' => $approvePosition == null ? '' : getSettingValueById($approvePosition->position)->name,
            'details' => $details ?? [],
            'type' => $type,
        ]);
    }
}
