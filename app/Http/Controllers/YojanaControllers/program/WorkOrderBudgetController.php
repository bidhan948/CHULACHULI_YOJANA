<?php

namespace App\Http\Controllers\YojanaControllers\program;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\WorkOrderRequest;
use App\Models\PisModel\Staff;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\program\work_order;
use App\Models\YojanaModel\program\work_order_detail;
use App\Models\YojanaModel\setting\list_registration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class WorkOrderBudgetController extends Controller
{
    public function index($reg_no)
    {
        return view('yojana.program.program_execution.work_order', [
            'program' => plan::query()
                ->where('reg_no', $reg_no)
                ->with('workOrder.listRegistrationAttribute.listRegistration', 'workOrder.workOrderDetail', 'workOrder.workOrderDetail.Staff')
                ->withSum(['workOrder as work_order_sum'], 'municipality_amount')
                ->first(),
            'regNo' => $reg_no,
            'list_registrations' => list_registration::query()->get(),
            'staffs' => Staff::query()->select('id', 'nep_name', 'user_id')->get(),
        ]);
    }

    public function store(WorkOrderRequest $request)
    {
        // Re-checking if client has edited any form by inspecting
        $program = plan::query()
            ->where('type_id', config('YOJANA.PROGRAM'))
            ->where('reg_no', $request->program_id)
            ->with('workOrder')
            ->first();

        if ($program == null) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back()->withInput();
        }

        $work_order_budget = $request->municipality_amount + $request->cost_participation + $request->cost_sharing;

        DB::transaction(function () use ($request, $program, $work_order_budget) {
            $work_order = work_order::create($request->except('post', 'post_id', 'staff_id', 'work_order_budget') +
                [
                    'work_order_no' => $program->workOrder->count() + 1,
                    'plan_id' => $request->program_id,
                    'work_order_budget' => $work_order_budget,
                    'fiscal_year_id' => getCurrentFiscalYear(true)->id
                ]);

            foreach ($request->post_id as $key => $post_id) {
                work_order_detail::create([
                    'work_order_id' => $work_order->id,
                    'post_id' => $post_id,
                    'staff_id' => $request->staff_id[$key]
                ]);
            }
        });

        toast(config('YojanaMessage.KARYADESH_MSG'), 'success');
        return redirect()->back();
    }

    public function edit(work_order $work_order): View
    {
        return view('yojana.program.program_execution.edit_work_order', [
            'work_order' => $work_order->load('workOrderDetail', 'Program', 'listRegistrationAttribute.listRegistration'),
            'list_registrations' => list_registration::query()->get(),
            'staffs' => Staff::query()->select('id', 'nep_name', 'user_id')->get(),
            'program' => plan::query()
                ->where('reg_no', $work_order->plan_id)
                ->withSum(['workOrder as work_order_sum' => function ($q) use ($work_order) {
                    $q->where('id', '!=', $work_order->id);
                }], 'municipality_amount')
                ->first()
        ]);
    }

    public function update(WorkOrderRequest $request, work_order $work_order): RedirectResponse
    {
        $work_order_budget = $request->municipality_amount + $request->cost_participation + $request->cost_sharing;

        DB::transaction(function () use ($request, $work_order_budget, $work_order) {
            $work_order->update($request->except('post', 'post_id', 'staff_id', 'work_order_budget') +
                ['work_order_budget' => $work_order_budget]);

            work_order_detail::query()->where('work_order_id', $work_order->id)->delete();

            foreach ($request->post_id as $key => $post_id) {
                work_order_detail::create([
                    'work_order_id' => $work_order->id,
                    'post_id' => $post_id,
                    'staff_id' => $request->staff_id[$key]
                ]);
            }
        });

        toast(config('YojanaMessage.KARYADESH_MSG'), 'success');
        return redirect()->route('work_order.index', [$work_order->plan_id]);
    }
}