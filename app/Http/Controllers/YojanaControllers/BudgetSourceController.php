<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\SharedModel\FiscalYear;
use App\Models\YojanaModel\BudgetSource;
use App\Models\YojanaModel\BudgetSourceDeposit;
use Illuminate\Http\Request;

class BudgetSourceController extends Controller
{
    public function index()
    {
        $current_fiscal_year = FiscalYear::where('is_current', true)->first();
        $budgetSources = BudgetSource::query()
            ->withSum(['budget_source_deposit as amount' => function ($query) use ($current_fiscal_year) {
                $query->where('fiscal_year_id', $current_fiscal_year->id);
            }], 'amount')
            ->withSum(['budget_source_plan as amountToBeSubtracted' => function ($query) {
                $query->where('is_split', 0)->where('is_merge',0);
            }], 'amount')
            ->with('budget_source_plan')
            ->get();
        return view('yojana.budget-source.index', ['data' => $budgetSources]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate(['name' => 'required']);
        $id = $request->id;
        if (empty($id)) {
            $db_response =  BudgetSource::create($validate);
            $id = $db_response->id;
        } else {
            BudgetSource::where('id', $request->id)->update($validate);
        }
        return response()->json(['id' => $id]);
    }

    public function store_amount(Request $request)
    {
        $validate = $request->validate([
            'entry_date_nep' => 'required',
            'entry_date_eng' => 'required',
            'amount' => 'required',
            'remarks' => 'required'
        ], [
            'remarks.required' => 'कैफियत आवश्यक छ |',
            'amount.required' => 'रकम आवश्यक छ |',
            'entry_date_nep.required' => 'मिति आवश्यक छ |',
            'entry_date_eng.required' => 'मिति आवश्यक छ |',
        ]);

        $current_fiscal_year = FiscalYear::where('is_current', true)->first();
        $current_budget_source = BudgetSource::where('id', $request->budget_source_id)->first();

        if (empty($current_budget_source)) return response()->json('बजेट श्रोत भेटिएन', 500);

        $current_budget_source_amount = BudgetSourceDeposit::where(['fiscal_year_id' => $current_fiscal_year->id, 'budget_source_id' => $current_budget_source->id])->get();
        $count = $current_budget_source_amount->count();

        if ($count > 0) {
            foreach ($current_budget_source_amount as $item) {
                if ($item->entry_date_eng > $request->entry_date_eng) {
                    return response()->json('पहिले थपिएको मिति ' . Nepali($item->entry_date_nep) . ' भन्दा अहिलेको मिति ' . Nepali($request->entry_date_nep) . ' कम भयो', 500);
                }
            }
        }

        $data_to_insert = $validate + [
            'fiscal_year_id' => $current_fiscal_year->id,
            'entry_index' => $count > 0 ? $count + 1 : 1,
            'remarks' => $request->remarks,
            'status' => 1,
            'budget_source_id' => $current_budget_source->id
        ];
        try {
            $db_response =  BudgetSourceDeposit::create($data_to_insert);
            $id = $db_response->id;
        } catch (\Exception $e) {
            return response()->json('डाटा थप्न असफल', 500);
        }

        return response()->json(['id' => $id]);
    }

    public function getById()
    {
        $budgetSources = BudgetSource::query()->where('id', request('id'))->first();
        return response()->json($budgetSources);
    }
}
