<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\NewPlanFormRequest;
use App\Http\Requests\YojanaRequest\PlanEditRequest;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\budget_source_plan;
use App\Models\YojanaModel\BudgetSource;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\plan_ward_detail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PlanController extends Controller
{
    public function index(): View
    {
        return view('yojana.plan.plan', [
            'type_of_allocations' => (Setting::query()
                ->where('slug', config('SLUG.type_of_allocation'))
                ->with('settingValues')
                ->first())->settingValues
        ]);
    }

    public function create(): View
    {
        $data = getSettingByKey([
            config('SLUG.expense_type'),
            config('SLUG.topic'),
            config('SLUG.sub_topic'),
        ]);
        $setting = setting::query()
        ->with('settingValues')
        ->where('slug',config('SLUG.type_of_allocation'))
        ->first();
        
        return view('yojana.plan.new_plan', [
            'expense_types' => $data['expense_types'],
            'topics' => $data['topics'],
            'type_of_allocations' => $setting,
            'budget_sources' => BudgetSource::query()
                ->get()
        ]);
    }


    public function store(NewPlanFormRequest $request): RedirectResponse
    {
        if ($request->grant_amount == 0) {
            Alert::error('कृपया रकम चेक गर्नुहोस्');
            return redirect()->back();
        }
        $fiscal_id = getCurrentFiscalYear(True)->id;
        $regNo = plan::query()->latest()->first();
        $msg = DB::transaction(function () use ($request, $regNo, $fiscal_id) {
            $plan = plan::create($request->except('ward_no', 'rakam', 'budget_source_id', 'budget_source_name') + [
                'reg_no' => $regNo == null ? 1 : $regNo->reg_no + 1,
                'entered_by' => auth()->user()->id,
                'ward_no' => $request->has('is_main') ? $request->is_main : 0,
                'fiscal_year_id' => $fiscal_id
            ]);

            foreach ($request->budget_source_id as $key => $budget_source_id) {
                budget_source_plan::create([
                    'plan_id' => $plan->id,
                    'budget_source_id' => $budget_source_id,
                    'amount' => $request->rakam[$budget_source_id]
                ]);
            }
            foreach ($request->ward_no as $key => $ward_no) {
                plan_ward_detail::create([
                    'plan_id' => $plan->id,
                    'ward_no' => $ward_no
                ]);
            }

            return $plan;
        });

        toast("योजना दर्ता हुन सफल भयो दर्ता नं : " . Nepali($msg->reg_no), 'success');
        return redirect()->route('plan.index');
    }

    public function breakDown(plan $plan): View
    {
        abort_if($plan->plan_id != null, 403);
        $data = getSettingByKey([
            config('SLUG.expense_type'),
            config('SLUG.topic'),
            config('SLUG.sub_topic'),
            config('SLUG.type_of_allocation')
        ]);
        return view('yojana.plan.break_down', [
            'expense_types' => $data['expense_types'],
            'topics' => $data['topics'],
            'type_of_allocations' => $data['type_of_plan_allocations'],
            'plan' => $plan->load('budgetSourcePlanDetails.budgetSources', 'Parents')
        ]);
    }

    public function storeBreakYojana(Request $request, plan $plan): RedirectResponse
    {
        if ($request->grant_amount == 0) {
            Alert::error('कृपया रकम चेक गर्नुहोस्');
            return redirect()->back();
        }
        $regNo = plan::query()->latest()->first();

        $id =  DB::transaction(function () use ($request, $regNo, $plan) {
            $plan_id = plan::create($request->except('ward_no', 'rakam', 'budget_source_id', 'budget_source_name') + [
                'reg_no' => $regNo == null ? 1 : $regNo->reg_no + 1,
                'entered_by' => auth()->user()->id,
                'plan_id' => $plan->id,
                'ward_no' => $request->has('is_main') ? $request->is_main : 0,
                'fiscal_year_id' => getCurrentFiscalYear(True)->id
            ]);

            foreach ($request->budget_source_id as $key => $budget_source_id) {
                budget_source_plan::create([
                    'plan_id' => $plan_id->id,
                    'budget_source_id' => $budget_source_id,
                    'amount' => $request->rakam[$budget_source_id],
                    'is_split' => true
                ]);
            }

            if ($request->has('is_main')) {
                plan_ward_detail::create(['plan_id' => $plan_id->id, 'ward_no' => $request->is_main, 'is_main' => true]);
            }

            foreach ($request->ward_no as $key => $ward_no) {
                plan_ward_detail::create([
                    'plan_id' => $plan_id->id,
                    'ward_no' => $ward_no
                ]);
            }

            return $plan_id->id;
        });

        toast("योजना टुक्राउन सफल दर्ता नं " . Nepali($id), 'success');
        return redirect()->route('plan.index');
    }

    public function edit(plan $plan,YojanaHelper $helper): View
    {
        // $plan_ward_details = plan::query()->whereDoesntHave('planWardDetails')->where('type_of_allocation_id',26)->get();
        // foreach($plan_ward_details as $plan_ward_detail)
        // {
        //     plan_ward_detail::create([
        //             'plan_id' => $plan_ward_detail->id,
        //             'ward_no' => $plan_ward_detail->ward_no
        //         ]);
        // }
        $data = getSettingByKey([
            config('SLUG.expense_type'),
            config('SLUG.topic'),
            config('SLUG.sub_topic'),
            config('SLUG.type_of_allocation')
        ]);
        $ward_object = $plan->load('wardDetail')->wardDetail;

        foreach ($ward_object as $key => $obj) {
            $ward_array[] = $obj->ward_no;
        }
        $fiscal_id = getCurrentFiscalYear(true)->id;
        $budget_sources = BudgetSource::query()->where('fiscal_year_id', $fiscal_id)->get();

        $html = '';
        foreach ($plan->load('budgetSourcePlanDetails.budgetSources')->budgetSourcePlanDetails as $parentKey => $budgetSourcePlanDetail) {
            $html .= '<tr id="re_'.($parentKey+1).'">';
            $html .= '<td class="text-center"><select name="budget_source_id"  class="form-control form-control-sm budget_source_id" id="budget_source_id_'.($parentKey+1).'" onchange="changeBudgetSource('.($parentKey+1).')" required>';
            foreach ($budget_sources as $key => $budget_source) {
                $html .= '<option value="' . $budget_source->id . '" ' . ($budgetSourcePlanDetail->budget_source_id == $budget_source->id ? "selected" : "") . '>'.$budget_source->name.'</option>';
            }
            $html .= '</select></td>';
            $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm rakam" oninput="changeRakam('.$budgetSourcePlanDetail->amount.','.$helper->calculateRemainAmountBudgetSource($budgetSourcePlanDetail->budget_source_id).','.($parentKey+1).')" id="rakam_'.($parentKey+1).'" name="rakam['.$budgetSourcePlanDetail->budget_source_id.']" value="'.$budgetSourcePlanDetail->amount.'" required></td>';
            $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm"  id="baki_'.($parentKey+1).'" value="'.$helper->calculateRemainAmountBudgetSource($budgetSourcePlanDetail->budget_source_id).'" readonly required></td>';
            $html .= '<td class="text-center"><a class="btn btn-sm btn-danger" onclick="removeTr('.($parentKey+1).')"><i class="fa-solid fa-xmark"></i></a></td></tr>';
        }
        return view('yojana.plan.edit_plan', [
            'plan' => $plan->load('budgetSourcePlanDetails.budgetSources'),
            'expense_types' => $data['expense_types'],
            'topics' => $data['topics'],
            'type_of_allocations' => $data['type_of_plan_allocations'],
            'budget_sources' => $budget_sources,
            'ward_array' => $ward_array ??[],
            'html' => $html
        ]);
    }

    public function update(PlanEditRequest $request, plan $plan): RedirectResponse
    {
        DB::beginTransaction();
        try {

            $plan->update($request->except('ward_no') + [
                'ward_no' => $request->has('is_main') ? $request->is_main : 0
            ]);

            plan_ward_detail::query()->where('plan_id', $plan->id)->delete();
            
            budget_source_plan::query()->where('plan_id',$plan->id)->delete();
            
            foreach ($request->ward_no as $key => $ward_no) {
                plan_ward_detail::create(['plan_id' => $plan->id, 'ward_no' => $ward_no, 'is_main' => false]);
            }

            foreach ($request->rakam as $budget_source_id => $amount) {
                budget_source_plan::create([
                    'plan_id' => $plan->id,
                    'budget_source_id' => $budget_source_id,
                    'amount' => $amount
                ]);
            }

            DB::commit();

            toast($plan->name . " सच्याउन सफल भयो", "success");
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Something went wrong...');
            return redirect()->back();
        }

        return redirect()->route('plan.index');
    }
}
