<?php

namespace App\Http\Controllers\YojanaControllers\setting;

use App\Http\Controllers\Controller;
use App\Models\YojanaModel\setting\deduction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeductionControllers extends Controller
{
    public function index(): View
    {
        return view('yojana.setting.deduction', [
            'deductions' => deduction::query()->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attribute = $request->validate(
            [
                'name' => 'required',
                'percent' => 'required',
                'is_active' => 'required'
            ]
        );

        deduction::create($attribute);
        toast("कट्टी विवरण शफल भयो", "success");
        return redirect()->back();
    }

    public function update(Request $request, deduction $deduction): RedirectResponse
    {
        $attribute = $request->validate(
            [
                'name' => ['required'],
                'percent' => 'required',
                'is_active' => 'required'
            ]
        );

        $deduction->update($attribute);
        toast("कट्टी विवरण सच्याउन शफल भयो", "success");
        return redirect()->back();
    }
}
