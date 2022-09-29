<?php

namespace App\Http\Controllers\YojanaControllers\program;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\ProgramAddDeadlineRequest;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\program\program_add_deadline;
use App\Models\YojanaModel\program\work_order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramAddDeadLineController extends Controller
{
    public function index($reg_no)
    {
        $program = plan::query()
            ->where('reg_no', $reg_no)
            ->first();

        if ($program == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        }

        return view('yojana.program.add_deadline.add_deadline', [
            'program' => $program,
            'reg_no' => $program->reg_no,
            'work_orders' => work_order::query()->where('plan_id', $program->id)->get(),
            'add_deadline' => program_add_deadline::query()
                ->where('plan_id', $program->id)
                ->get()
        ]);
    }

    public function store(ProgramAddDeadlineRequest $request): RedirectResponse
    {
        $period = program_add_deadline::query()
            ->where('work_order_id', $request->work_order_id)
            ->count();

        program_add_deadline::create($request->validated() + ['period' => $period + 1]);

        toast("अन्तिम म्याद हाल्न सफल भयो", "success");
        return redirect()->back();
    }

    public function edit(program_add_deadline $program_add_deadline)
    {
        $program = plan::query()->where('id', $program_add_deadline->plan_id)->first();

        $period_add_date_nep = program_add_deadline::query()
            ->where('period', $program_add_deadline->period - 1)
            ->where('plan_id', $program->id)
            ->first();

        $program_add_deadline_object = program_add_deadline::query()
            ->where('work_order_id', $program_add_deadline->work_order_id)
            ->latest()
            ->first();

        $isEditable = $program_add_deadline->period == $program_add_deadline_object->period ? true : false;

        $date = $program_add_deadline->period == 1 ? $program_add_deadline->load('workOrder')->workOrder->program_end_date_nep : $period_add_date_nep->period_add_date_nep;
        return view('yojana.program.add_deadline.edit_add_deadline', [
            'program_add_deadline' => $program_add_deadline->load('workOrder'),
            'program' => $program,
            'reg_no' => $program->reg_no,
            'date' => $date,
            'isEditable' => $isEditable
        ]);
    }

    public function update(Request $request, program_add_deadline $program_add_deadline)
    {
        $attribute = $request->validate([
            'plan_id' => 'required',
            'letter_date_nep' => 'required',
            'institution_date_add_nep' => 'required',
            'period_add_date_nep' => 'required',
            'remark' => 'required'
        ]);

        $program_add_deadline->update($attribute);
        toast("अन्तिम म्याद सच्याउन सफल भयो", "success");
        return redirect()->back();
    }
}