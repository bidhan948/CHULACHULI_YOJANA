<?php

namespace App\Http\Controllers\YojanaControllers\setting;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Imports\PlanImport;
use App\Models\YojanaModel\budget_source_plan;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\plan_ward_detail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Facades\Excel;

class ExcelUploaderController extends Controller
{
    public function index(): View
    {
        return view('yojana.setting.excel_upload');
    }

    public function store(Request $request, YojanaHelper $helper): RedirectResponse
    {
        $request->validate(['name' => ['required']]);
        $budget_source_array = [];
        $fiscal_id = getCurrentFiscalYear(TRUE)->id;
        DB::beginTransaction();
        try {
            $reg_no = $helper->returnLatestRegNo(new plan());
            $data = Excel::toCollection(new PlanImport, $request->file('name'));
            $data = $data[0];
            for ($loop = 1; $loop < count($data); $loop++) {      
                $grant_amount = 0;          
                $budget_source = $data[$loop][config('EXCEL_CONSTANT.budget_source')];
                $budget_array = explode(',', $budget_source);

                if ($data[$loop][config('EXCEL_CONSTANT.kshtera')]) {
                    $kshera_array = explode('-', $data[$loop][config('EXCEL_CONSTANT.kshtera')]);
                }

                $kharcha = $helper->returnKharchType($data[$loop][config('EXCEL_CONSTANT.kharcha')]);
                foreach ($budget_array as $key => $b_a) {
                    $temp_budget = explode('-', $b_a);
                    $budget_source_array[$temp_budget[0]] = $temp_budget[1];
                    $grant_amount += $temp_budget[1];
                }

                $ward_array = $data[$loop][config('EXCEL_CONSTANT.sanchalan_hune_ward')] == null ?
                    [] :
                    explode(',', $data[$loop][config('EXCEL_CONSTANT.sanchalan_hune_ward')]);
                $plan = plan::create(
                    [
                        'reg_no' => $reg_no,
                        'name' => $data[$loop][config('EXCEL_CONSTANT.name')],
                        'fiscal_year_id' => $fiscal_id,
                        'expense_type_id' => $kharcha,
                        'type_id' => English($data[$loop][config('EXCEL_CONSTANT.type')]),
                        'topic_id' => isset($kshera_array) ? $kshera_array[0] : 0,
                        'topic_area_type_id' => isset($kshera_array) ? $kshera_array[1] : 0,
                        'type_of_allocation_id' => English($data[$loop][config('EXCEL_CONSTANT.binyojan_kisim')]),
                        'grant_amount' => English($data[$loop][config('EXCEL_CONSTANT.anudan')]),
                        'detail' => $data[$loop][config('EXCEL_CONSTANT.binyojit_shrot_bakhya')],
                        'ward' => English($data[$loop][config('EXCEL_CONSTANT.sanchalan_garne_ward')])
                    ]
                );

                foreach ($budget_source_array as $budget_source_key => $budget_source_amount) {
                    budget_source_plan::create([
                        'plan_id' => $plan->id,
                        'budget_source_id' => $budget_source_key,
                        'amount' => English($budget_source_amount)
                    ]);
                }

                foreach ($ward_array as $ward_arr) {
                    plan_ward_detail::create([
                        'plan_id' => $plan->id,
                        'ward_no' => $ward_arr
                    ]);
                }

                $budget_source_array = [];
                $kshera_array = [];
                $ward_array = [];
                $reg_no++;
            }
            toast('EXCEL UPLOADED SUCCESSFULLY', "success");
        } catch (Exception $e) {
            DB::rollback();
            toast("something went wrong");
            return redirect()->back();
        }
        return redirect()->back();
    }
}
