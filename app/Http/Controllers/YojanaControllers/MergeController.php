<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\YojanaModel\budget_source_plan;
use App\Models\YojanaModel\merge_plan;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\plan_ward_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MergeController extends Controller
{
    public function index()
    {
        return view('yojana.setting.merge.yojana_merge');
    }

    public function store(Request $request)
    {
        $attribute = $request->validate(['reg_no.*' => 'required']);

        if (count(collect($attribute)->duplicates()) > 0) {
            Alert::error('योजना दर्ता नं दोहोरियो');
            return redirect()->back();
        }

        $budgetArray = [];
        $opearteWardNo = [];
        $topic_id = null;
        $topic_area_type_id = null;
        $planWardNo = null;

        $plans = plan::query()->whereIn('reg_no', $request->reg_no)
            ->with('budgetSourcePlanDetails')
            ->with('wardDetail')
            ->get();

        try {
            DB::beginTransaction();
            // this is for setting budget source and to be opertaed ward no in an array
            foreach ($request->reg_no as $key => $reg_no) {
                $plan = $plans->where('reg_no', $reg_no)->first();

                $plan->update(['is_merge' => true]);

                foreach ($plan->budgetSourcePlanDetails as $key => $budgetSourcePlanDetail) {
                    $budgetSourcePlanDetail->update(['is_merge' => true]);
                    if (!array_key_exists($budgetSourcePlanDetail->budget_source_id, $budgetArray)) {
                        $budgetArray[$budgetSourcePlanDetail->budget_source_id] = $budgetSourcePlanDetail->amount;
                    } else {
                        $budgetArray[$budgetSourcePlanDetail->budget_source_id] += $budgetSourcePlanDetail->amount;
                    }
                }

                foreach ($plan->wardDetail as $key => $wardDetail) {
                    if (!in_array($wardDetail->ward_no, $opearteWardNo)) {
                        $opearteWardNo[] = $wardDetail->ward_no;
                    }
                }
            }

            // this is for setting topic id and topic area type id
            if ($plans->unique('topic_id')->count() == 1) {
                $topic_id = $plans[0]->topic_id;
                if ($plans->unique('topic_area_type_id')->count() == 1) {
                    $topic_area_type_id = $plans[0]->topic_area_type_id;
                }
            }

            // setting allocation id
            $allocationId = $plans->contains('type_of_allocation_id', config('constant.nagar_stariya_id')) ? config('constant.nagar_stariya_id') : config('constant.wada_stariya_id');

            $grantAmount = array_sum($budgetArray);

            // setting Main ward
            if ($allocationId != config('constant.nagar_stariya_id')) {
                if ($plans->unique('ward_no')->count() == 1) {
                    $planWardNo = $plans[0]->ward_no;
                }
            }

            $Mergeplan = plan::create([
                'reg_no' => plan::query()->latest()->first()->reg_no + 1,
                'name' => $plans->implode('name', ','),
                'expense_type_id' => config('YOJANA.EXPENSE_TYPE.CAPITAL_EXPENDITURE_ID'),
                'type_id' => config('YOJANA.PLAN'),
                'topic_area_type_id' => $topic_area_type_id,
                'topic_id' => $topic_id,
                'type_of_allocation_id' => $allocationId,
                'grant_amount' => $grantAmount,
                'ward_no' => $planWardNo == null ? 0 : $planWardNo
            ]);

            foreach ($budgetArray as $key => $budget) {
                budget_source_plan::create([
                    'plan_id' => $Mergeplan->id,
                    'budget_source_id' => $key,
                    'amount' => $budget,
                ]);
            }

            foreach ($opearteWardNo as $key => $ward_no) {
                plan_ward_detail::create([
                    'plan_id' => $Mergeplan->id,
                    'ward_no' => $ward_no
                ]);
            }

            foreach ($plans as $key => $mergePlan) {
                merge_plan::create([
                    'plan_id' => $Mergeplan->id,
                    'merge_id' => $mergePlan->id
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            toast(config('YojanaMessage.SERVER_ERROR'), 'error');
            return redirect()->back();
        }

        toast('योजना जोड्न सफल भयो', 'success');
        return redirect()->back();
    }
}
