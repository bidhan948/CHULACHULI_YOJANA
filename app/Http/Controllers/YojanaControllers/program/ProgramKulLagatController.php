<?php

namespace App\Http\Controllers\YojanaControllers\program;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\ProgramKulLagatRequest;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\program\program_kul_lagat;
use App\Models\YojanaModel\program\work_order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramKulLagatController extends Controller
{
    public function index($reg_no): View
    {
        $progarm = plan::query()
            ->where('reg_no', $reg_no)
            ->where('type_id', config('YOJANA.PROGRAM'))
            ->with('workOrder')
            ->first();

        abort_if($progarm == null, 404);

        return view('yojana.program.kul-lagat.search_work_order', [
            'program' => $progarm,
            'regNo' => $reg_no
        ]);
    }

    public function create(Request $request)
    {
        $validate = $request->validate(['work_order_id' => 'required']);

        return redirect()->route('work_order.create_kul_lagat', ['work_order' => $request->work_order_id]);
    }

    public function showForm(work_order $work_order)
    {
        $plan = plan::query()->where('id',$work_order->plan_id)->first();
        return view('yojana.program.kul-lagat.create_kul_lagat', [
            'work_order' => $work_order->load('programKulLagat'),
            'plan' => $plan,
            'regNo' => $plan->reg_no,
            'units' => Setting::query()->where('slug',config('SLUG.units'))->with('settingValues')->first()
        ]);
    }

    public function store(ProgramKulLagatRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            program_kul_lagat::query()
                ->where('work_order_id', $request->work_order_id)
                ->delete();

            foreach ($request->unit_id as $key => $unit_id) {
                program_kul_lagat::create([
                    'work_order_id' => $request->work_order_id,
                    'unit_id' => $unit_id,
                    'unit_price' => English($request->unit_price[$key]),
                    'quantity' => English($request->quantity[$key]),
                    'total' => English($request->unit_price[$key]) * English($request->quantity[$key]),
                    'bibaran' => $request->bibaran[$key],
                    'remark' => $request->remark[$key],
                ]);
            }
        });

        toast('कार्यक्रमको कुल लागत अनुमान हाल्न सफल भयो', 'success');
        return redirect()->back();
    }
}