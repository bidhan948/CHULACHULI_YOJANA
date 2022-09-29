<?php

namespace App\Http\Controllers\YojanaControllers\program;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\ProgramAdvanceRequest;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\program\program_advance;
use App\Models\YojanaModel\program\work_order;
use Illuminate\Contracts\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramAdvanceController extends Controller
{
    public function index($reg_no)
    {
        $program = plan::query()
            ->select('id', 'reg_no', 'name')
            ->where('reg_no', $reg_no)
            ->first();

        if ($program == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $work_order_count =  work_order::query()->where('plan_id', $program->id)->count();

        if (!$work_order_count) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        $program_advance = program_advance::query()
            ->where('plan_id', $program->id)
            ->with('workOrder')
            ->get();

        return view('yojana.program.peski.advance', [
            'reg_no' => $reg_no,
            'program' => $program,
            'work_order' => work_order::query()
                ->where('plan_id', $program->id)
                ->where('work_order_no', $program_advance->count() + 1)
                ->first(),
            'program_advances' => $program_advance
        ]);
    }

    public function store(ProgramAdvanceRequest $request)
    {
        $program_advance_count = program_advance::query()->where('plan_id', $request->program_id)->count();

        $work_order = work_order::query()
            ->where('plan_id', $request->program_id)
            ->where('work_order_no', $program_advance_count + 1)
            ->first();

        program_advance::create($request->validated() + [
            'plan_id' => $request->program_id,
            'work_order_id' => $work_order->id
        ]);

        toast("पेश्की हाल्न सफल भयो", "success");
        return redirect()->back();
    }

    public function edit(program_advance $program_advance): View
    {
        $program = plan::query()->where('id', $program_advance->plan_id)->first();
        $program_advance_check = program_advance::query()->where('plan_id', $program->id)->latest()->first();
        abort_if($program_advance->id != $program_advance_check->id, 404);
        return view('yojana.program.peski.edit_advance', [
            'program' => $program,
            'program_advance' => $program_advance->load('workOrder'),
            'reg_no' => $program->reg_no,
        ]);
    }

    public function update(ProgramAdvanceRequest $request, program_advance $program_advance)
    {
        $program = plan::query()->where('id', $program_advance->plan_id)->first();
        $program_advance->update($request->validated());
        toast("पेश्की सच्याउन सफल भयो", "success");
        return redirect()->route('program.work_order.advance', ['reg_no' => $program->reg_no]);
    }
}