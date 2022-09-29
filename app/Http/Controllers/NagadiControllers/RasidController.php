<?php

namespace App\Http\Controllers\NagadiControllers;

use App\Http\Controllers\Controller;
use App\Models\NagadiModel\Category;
use App\Models\NagadiModel\Rasid;
use App\Models\NagadiModel\RasidDetail;
use App\Models\SharedModel\FiscalYear;
use App\Models\SharedModel\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RasidController extends Controller
{
    public function index()
    {
        session(['active_app' => 'nagadi']);
        $data = Rasid::where('status', 1)->with('fiscal_year')->get();
        return view('nagadi.rasid.index', ['data' => $data]);
        // return redirect()->back
    }

    public function report(Request $request, $key)
    {
        session(['active_app' => 'nagadi']);
        $report_type = $key;
        if ($report_type != 'mashik_report' && $report_type != 'dainik_report') {
            abort(404);
        }

        $fiscal_years = FiscalYear::get();

        $from_date = $request->from_date_eng;
        $to_date = $request->to_date_eng;
        $fiscal_year_id = $request->fiscal_year_id;

        if (empty($fiscal_year_id)) {
            $current_fiscal_year = getCurrentFiscalYear(true)->id;
            $fiscal_year_id = $current_fiscal_year;
        }

        $filter = [
            'rasids.status' => 1,
            'rasids.fiscal_year_id' => $fiscal_year_id
        ];

        if ($report_type == 'mashik_report') {
            if($request->method() == 'POST') {
                if ($from_date != '' && $to_date == '') {
                    return back()->withErrors([
                        'to_date' => 'अन्तिम मिति आवश्यक छ|',
                    ]);
                }
                if ($from_date == '') {
                    return back()->withErrors([
                        'from_date' => 'सुरु मिति आवश्यक छ|',
                    ]);
                }
            }
            $data = RasidDetail::query()
                ->selectRaw("categories.id as main_sirsak_id, categories.name as main_sirsak_name ,categories.topic_number as sirsak_number,SUM(rasid_details.total) as total")
                ->join('rasids', 'rasid_details.rasid_id', '=', 'rasids.id')
                ->join('categories', 'rasid_details.main_sirsak', '=', 'categories.id')
                ->where($filter)
                ->whereBetween('rasids.date_eng', [$from_date, $to_date])
                ->groupBy('categories.id')->get();

            $from_date_nep = convertAdToBs($from_date);
            $to_date_nep = convertAdToBs($to_date);
            return view('nagadi.rasid.report', [
                'data' => $data,
                'fiscal_years' => $fiscal_years,
                'report_type' => $report_type,
                'from_date_nep' => $from_date_nep,
                'to_date_nep' => $to_date_nep,
                'from_date' => $from_date,
                'to_date' => $to_date
            ]);
        }

        if ($report_type == 'dainik_report') {
            if (empty($from_date)) {
                $from_date = date('Y-m-d');
            }
            $filter['rasids.date_eng'] = $from_date;
            $data = RasidDetail::query()
                ->selectRaw("categories.id as main_sirsak_id, categories.name as main_sirsak_name ,categories.topic_number as sirsak_number,SUM(rasid_details.total) as total")
                ->join('rasids', 'rasid_details.rasid_id', '=', 'rasids.id')
                ->join('categories', 'rasid_details.main_sirsak', '=', 'categories.id')
                ->where($filter)
                ->groupBy('categories.id')->get();

            $from_date_nep = convertAdToBs($from_date);
            return view('nagadi.rasid.report', ['data' => $data, 'fiscal_years' => $fiscal_years, 'report_type' => $report_type, 'from_date_nep' => $from_date_nep,'from_date' => $from_date,]);
        }
    }

    public function rasid_detail(Request $request, $id)
    {
        if (empty($id)) {
        }

        return view('nagadi.rasid.detail_report_table', ['id' => $id]);
    }
    public function create()
    {
        session(['active_app' => 'nagadi']);
        $current_fiscal_year = FiscalYear::where('is_current', true)->first();
        $provinces = Province::get();
        $main_sirsaks = Category::query()->where('pid', null)->get();
        return view('nagadi.rasid.create', [
            'provinces' => $provinces,
            'current_fiscal_year' => $current_fiscal_year,
            'main_sirsaks' => $main_sirsaks
        ]);
        // return redirect()->back
    }
    public function store(Request $request)
    {
        /*
            TODO :: validation

            3. sirsak is required if upa_sirsak has child
       */

        session(['active_app' => 'nagadi']);
        dd($request->all());
        $current_fiscal_year = FiscalYear::where('is_current', true)->first();
        $current_user = auth()->user();

        $validate_rasid = $request->validate([
            'date_nep' => 'required',
            'fiscal_year_id' => 'required',
            'customer_name' => 'required',
            'provience' => 'required',
            'district' => 'required',
            'gapa_napa' => 'required',
            'ward' => 'required',
            'recieved_amount' => 'required',
            'payment_mode' => 'required',
        ]);

        $request->validate([
            'main_sirsak.*' => 'required',
            'upa_sirsak.*' => 'required',
            'rate.*' => 'required',
            'total.*' => 'required'
        ]);

        DB::transaction(function () use ($request, $validate_rasid, $current_user, $current_fiscal_year) {
            $rasid_data = $validate_rasid + [
                'pan_no' => $request->pan_no,
                'grand_total' => $request->grand_total,
                'return_amount' => $request->return_amount,
                'payment_mode' => $request->payment_mode,
                'bank' => $request->bank,
                'fiscal_year_id' => $current_fiscal_year->id,
                'date_nep' => convertAdToBs(now()),
                'cheque_number' => $request->cheque_number,
                'status' => 1,
                'created_by' => $current_user->id,
            ];

            $rasid = Rasid::create($rasid_data);

            // dd($rasid);

            foreach ($request->main_sirsak as $key => $item) {
                $upa_sirsak = $request->upa_sirsak[$key];
                $sirsak = $request->sirsak[$key];
                $anya_sirsak = $request->anya_sirsak[$key];
                $parimad = $request->parimad[$key];
                $rate = $request->rate[$key];
                $rate_type = $request->rate_type[$key];
                $total = $request->total[$key];

                $rasid_detail = [
                    'main_sirsak' => $item,
                    'upa_sirsak' => $upa_sirsak,
                    'sirsak' => $sirsak,
                    'anya_sirsak' => $anya_sirsak,
                    'parimad' => $parimad,
                    'rate' => $rate,
                    'rate_type' => $rate_type,
                    'total' => $total,
                    'rasid_id' => $rasid->id
                ];

                RasidDetail::create($rasid_detail);
            }
        });
        return redirect()->back();
    }


    public function cancel_rasid(Request $request)
    {
        $validate = $request->validate(['cancel_reason' => 'required']);

        $id = $request->id;
        $rasid = Rasid::where(['id' => $id, 'status' => 0])->first();
        if (empty($rasid)) {
            return response('रसिद भेटिएन', 404);
        }
        $current_fiscal_year = FiscalYear::where('is_current', true)->first();

        if ($rasid->fiscal_year_id  != $current_fiscal_year->id) {
            return response('चालु आर्थिक बर्षको रसिद मात्रै रद्द गर्न सकिन्छ |', 404);
        }
        $user = auth()->user();
        $data_to_update = $validate + [
            'cancel_date_nep' => convertAdToBs(now()),
            'cancel_date_eng' => now(),
            'updated_by' => $user->id,
            'status' => 1
        ];
        $rasid->update($data_to_update);
        return response('रद्द गर्न सफल', 200);
    }


    public function rasid_number_list()
    {
        return view('nagadi.rasid.rasid_number_list');
    }

}
