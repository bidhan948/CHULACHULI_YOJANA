<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use App\Models\User;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\program\work_order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        session(['active_app' => 'yojana']);
        $fiscal_id = getCurrentFiscalYear(true)->id;

        for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++) {
            if (!$i) {
                $ward[] = "गाउँपालिका";
            } else {
                $ward[] = 'वडा नं ' . $i;
            }
        }
        $pieChartArray = [];

        $setting = Setting::query()
            ->where('slug', config('SLUG.topic'))
            ->first();

        $planTopic = plan::query()
            ->select('id', 'type_id', 'fiscal_year_id', 'topic_id')
            ->where('type_id', config('YOJANA.PLAN'))
            ->where('fiscal_year_id', $fiscal_id)
            ->where('is_merge', 0)
            ->whereDoesntHave('Parents')
            ->with('Topic')
            ->get()
            ->groupBy('topic_id')
            ->values();

        foreach ($planTopic as $key => $pTopic) {
            $pieChartArray[$pTopic[0]->Topic->name] = $pTopic->count();
        }

        $topics = SettingValue::query()
            ->where('setting_id', $setting->id)
            ->pluck('name')
            ->toArray();

        foreach ($topics as $topic) {
            if (!array_key_exists($topic, $pieChartArray)) {
                $pieChartArray[$topic] = 0;
            }
        }

        return view('yojana.home.index', [
            'total_plan_regs_count' => Nepali(plan::query()
                ->where('type_id', config('YOJANA.PLAN'))
                ->whereNull('plan_id')
                ->where('is_merge', 0)
                ->where('fiscal_year_id', $fiscal_id)
                ->count()),
            'total_break_plan_count' => Nepali(plan::query()
                ->where('type_id', config('YOJANA.PLAN'))
                ->whereNotNull('plan_id')
                ->where('is_merge', 0)
                ->where('fiscal_year_id', $fiscal_id)
                ->count()),
            'total_program_regs_count' => Nepali(plan::query()
                ->where('type_id', config('YOJANA.PROGRAM'))
                ->where('fiscal_year_id', $fiscal_id)
                ->count()),
            'total_plan_with_other_bibaran' => Nepali(plan::query()
                ->where('type_id', config('YOJANA.PLAN'))
                ->where('fiscal_year_id', $fiscal_id)
                ->whereNull('plan_id')
                ->whereHas('otherBibaran')
                ->count()),
            'total_break_plan_with_other_bibaran' => Nepali(plan::query()
                ->where('type_id', config('YOJANA.PLAN'))
                ->where('fiscal_year_id', $fiscal_id)
                ->whereNotNull('plan_id')
                ->whereHas('otherBibaran')
                ->count()),
            'total_program_with_other_bibaran' => Nepali(plan::query()
                ->where('type_id', config('YOJANA.PROGRAM'))
                ->where('fiscal_year_id', $fiscal_id)
                ->whereHas('workOrder')
                ->count()),
            'total_work_order_count' => Nepali(work_order::query()
                ->where('fiscal_year_id', $fiscal_id)
                ->count()),
            'total_final_bill_payment_count' => Nepali(plan::query()
                ->where('fiscal_year_id', $fiscal_id)
                ->where('type_id', config('YOJANA.PLAN'))
                ->whereHas('finalPayment')
                ->count()),
            'total_running_bill_payment_count' => Nepali(plan::query()
                ->where('fiscal_year_id', $fiscal_id)
                ->where('type_id', config('YOJANA.PLAN'))
                ->whereHas('runningBillPayments')
                ->count()),
            'wards' => $ward,
            'topics' => $topics,
            'pie_chart_array' => $pieChartArray
        ]);
    }

    public function barGraphReport()
    {
        $fiscal_id = getCurrentFiscalYear(true)->id;
        for ($i = 0; $i <= config('constant.TOTAL_WARDS'); $i++) {
            if (!$i) {
                $ward[] = "गाउँपालिका";
            } else {
                $ward[] = 'वडा नं ' . $i;
            }
        }
        $html_id = "bar_" . random_int(5, 10);
        return response()->json([
            'total_plan_regs_count' => (plan::query()
                ->where('type_id', config('YOJANA.PLAN'))
                ->whereNull('plan_id')
                ->when(request('ward'), function ($q) {
                    $q->where('ward_no', request('ward'));
                })
                ->where('is_merge', 0)
                ->where('fiscal_year_id', $fiscal_id)
                ->count()),
            'total_break_plan_count' => (plan::query()
                ->where('type_id', config('YOJANA.PLAN'))
                ->when(request('ward'), function ($q) {
                    $q->where('ward_no', request('ward'));
                })
                ->whereNotNull('plan_id')
                ->where('is_merge', 0)
                ->where('fiscal_year_id', $fiscal_id)
                ->count()),
            'total_plan_with_other_bibaran' => (plan::query()
                ->where('type_id', config('YOJANA.PLAN'))
                ->where('fiscal_year_id', $fiscal_id)
                ->when(request('ward'), function ($q) {
                    $q->where('ward_no', request('ward'));
                })
                ->whereNull('plan_id')
                ->whereHas('otherBibaran')
                ->count()),
            'total_break_plan_with_other_bibaran' => (plan::query()
                ->where('type_id', config('YOJANA.PLAN'))
                ->where('fiscal_year_id', $fiscal_id)
                ->when(request('ward'), function ($q) {
                    $q->where('ward_no', request('ward'));
                })
                ->whereNotNull('plan_id')
                ->whereHas('otherBibaran')
                ->count()),
            'total_program_with_other_bibaran' => (plan::query()
                ->where('type_id', config('YOJANA.PROGRAM'))
                ->where('fiscal_year_id', $fiscal_id)
                ->whereHas('workOrder')
                ->count()),
            'total_work_order_count' => (work_order::query()
                ->where('fiscal_year_id', $fiscal_id)
                ->count()),
            'total_final_bill_payment_count' => (plan::query()
                ->where('fiscal_year_id', $fiscal_id)
                ->where('type_id', config('YOJANA.PLAN'))
                ->when(request('ward'), function ($q) {
                    $q->where('ward_no', request('ward'));
                })
                ->whereHas('finalPayment')
                ->count()),
            'total_running_bill_payment_count' => (plan::query()
                ->where('fiscal_year_id', $fiscal_id)
                ->where('type_id', config('YOJANA.PLAN'))
                ->when(request('ward'), function ($q) {
                    $q->where('ward_no', request('ward'));
                })
                ->whereHas('runningBillPayments')
                ->count()),
            'wards' => $ward,
            'html' => '<canvas id="' . $html_id . '" width="800" height="300"></canvas>',
            'html_id' => $html_id,
            'ward_msg' => '<span class="text-center font-weight-bold">' . (request('ward') ? "वडा नं " . Nepali(request('ward')) : config('constant.SITE_TYPE')) . ' को योजनाको मुख्य विवरण</span>'
        ]);
    }
}
