<?php

namespace App\Http\Controllers\YojanaController\setting;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffService;
use App\Models\SharedModel\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(): View
    {
        return view('yojana.setting.staff', [
            'staffs' => Staff::query()
                ->with('staffService')
                ->get(),
            'posts' => Setting::query()
                ->where('slug', config('SLUG.post'))
                ->with('settingValues')
                ->first()
        ]);
    }

    public function store(Request $request, YojanaHelper $helper): RedirectResponse
    {
        $request->validate(['nep_name' => 'required', 'pos' => 'required', 'position' => 'required']);
        $user_id = $helper->uniqueUid();
        Staff::create($request->except('position') + ['user_id' => $user_id]);
        StaffService::create(
            [
                'user_id' => $user_id,
                'position' => $request->position
            ]
        );
        toast("कर्मचारी थप्न सफल भयो", "success");
        return redirect()->back();
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate(['nep_name' => 'required', 'pos' => 'required', 'position' => 'required']);
        $staff->update($request->only('nep_name', 'pos'));
        StaffService::query()->where('user_id', $staff->user_id)->update(['position' => $request->position]);
        toast("कर्मचारी सच्याउन सफल भयो", "success");
        return redirect()->back();
    }
}
