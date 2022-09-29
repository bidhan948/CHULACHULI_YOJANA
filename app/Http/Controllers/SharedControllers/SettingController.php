<?php

namespace App\Http\Controllers\SharedControllers;

use App\Http\Controllers\Controller;
use App\Models\SharedModel\bank;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $setting = Setting::query()->where(['slug' => $request->slug, 'is_deleted' => false])->first();
        abort_if($setting == null, 404);
        $setting_values = SettingValue::query()->where(['setting_id' => $setting->id, 'is_deleted' => false])->get();

        return view('shared.setting.index', ['setting' => $setting, 'setting_values' => $setting_values]);
    }

    public function store(Request $request)
    {
        $setting = Setting::query()->where(['id' => $request->setting_id])->first();
        if (!empty($setting->cascading_parent_id)) {
            $validate = $request->validate(['name' => 'required', 'cascading_parent_id' => 'required', 'setting_id' => 'required']);
        } else {
            $validate = $request->validate(['name' => 'required', 'setting_id' => 'required']);
        }
        $id = $request->id;
        if (empty($id)) {
            $db_response =  SettingValue::create($validate + ['note' => $request->note]);
            $id = $db_response->id;
        } else {
            SettingValue::where('id', $request->id)->update($validate + ['note' => $request->note]);
        }
        return response()->json(['id' => $id]);
    }

    public function getById(Request $request)
    {
        $settings = Setting::query()->where('id', $request->id)->first();
        return response()->json($settings);
    }

    public function list(): View
    {
        return view('shared.setting.list', [
            'settings' => Setting::query()
                ->updatedIn(session('active_app'))
                ->get(),
            'settingParents' => Setting::query()
                ->updatedIn(session('active_app'))
                ->Parents()
                ->get()
        ]);
    }

    public function storeSetting(Request $request)
    {
        // return response()->json(['data'=>session('active_app')]);
        $validate = $request->validate(
            [
                'name' => 'required',
                'slug' => 'required|unique:setup_settings',
                'cascading_parent_id' => 'present',
                'has_child' => 'present'
            ]
        );

        Setting::create($validate + ['can_be_updated_in_' . session('active_app') => TRUE]);

        return response()->json(['message' => 'सेटिङ्ग थप्न सफल भयो'], 200);
    }

    public function editSetting(Request $request, Setting $setting): RedirectResponse
    {
        $validate = $request->validate(
            [
                'name' => 'required',
                'cascading_parent_id' => 'sometimes',
                'has_child' => 'present'
            ]
        );

        $setting->update($validate);
        toast('सेटिङ्ग सच्याउन सफल भयो ', 'success');
        return redirect()->back();
    }

    public function bank_list(): View
    {
        return view('shared.setting.create_bank', [
            'banks' => bank::query()->get()
        ]);
    }

    public function storeBank(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required', 'name_eng' => "present", 'address' => "required"]);
        bank::create($validate);
        toast("बैंक थप्न सफल भयो", "success");
        return redirect()->back();
    }
    
    public function updateBank(Request $request, bank $bank): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required', 'name_eng' => "present", 'address' => "required"]);
        $bank->update($validate);
        toast("बैंक सच्याउन सफल भयो", "success");
        return redirect()->back();
    }
}
