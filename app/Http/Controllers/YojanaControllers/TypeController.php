<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\consumer;
use App\Models\YojanaModel\kul_lagat;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\tole_bikas_samiti;
use App\Models\YojanaModel\setting\tole_bikas_samiti_detail;
use App\Models\YojanaModel\type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\YojanaControllers\ConsumerController;
use App\Http\Controllers\YojanaControllers\setting\AmanatController;
use App\Http\Controllers\YojanaControllers\setting\InstiutionalCommitteeController;

class TypeController extends Controller
{

    public function index($reg_no)
    {
        $kul_lagat = kul_lagat::query()
            ->where('plan_id', $reg_no)
            ->first();

        if ($kul_lagat == null) {
            Alert::error(config('YojanaMessage.INCOMPLETE_FORM_ERROR'));
            return redirect()->back();
        } else {

            $type = type::query()
                ->where('plan_id', $reg_no)
                ->first();

            if (session('type_id') == config('TYPE.UPABHOKTA_SAMITI')) {
                return redirect()->action(
                    [ConsumerController::class, 'index'],
                    ['reg_no' => $reg_no]
                );
            } elseif (session('type_id') == config('TYPE.SANSTHA_SAMITI')) {
                return redirect()->action(
                    [InstiutionalCommitteeController::class, 'index'],
                    ['reg_no' => $reg_no]
                );
            } elseif (session('type_id') == config('TYPE.AMANAT_MARFAT')) {
                return redirect()->action(
                    [AmanatController::class, 'index'],
                    ['reg_no' => $reg_no]
                );
            }

            if ($type != null) {
                $view = 'edit_type_tole';
                $tole_bikas_samiti_details = tole_bikas_samiti_detail::query()
                    ->where('tole_bikas_samiti_id', $type->typeable->id)
                    ->get();
            } else {
                $view = 'create_type_tole';
            }

            return view('yojana.type.' . $view, [
                'kul_lagat' => $kul_lagat,
                'plan' => plan::query()
                    ->where('reg_no', $reg_no)
                    ->first(),
                'regNo' => $reg_no,
                'posts' => Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues', function ($q) {
                        $q->where('id', '!=', config('constant.TOLE_SAMYOJAK_ID'));
                    })
                    ->first(),
                'tole_bikas_samitis' => tole_bikas_samiti::query()
                    ->with('toleBikasSamitiDetails')
                    ->get(),
                'type' => $type,
                'tole_bikas_samiti_details' => $tole_bikas_samiti_details ?? []
            ]);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['tole_bikas_samiti_id' => 'required']);
        type::create(
            [
                'typeable_id' => $request->tole_bikas_samiti_id,
                'typeable_type' => type::NAMESPACE_TOLE_BIKAS_SAMITI,
                'plan_id' => $request->plan_id,
                'entered_by' => auth()->user()->name
            ]
        );

        toast(config('TYPE.' . session('type_id')) . "को विवरण हाल्न सफल भयो ", "success");
        return redirect()->back();
    }

    public function update(Request $request, type $type): RedirectResponse
    {
        $validate = $request->validate(['tole_bikas_samiti_id' => 'required']);
        $type->update($validate);
        toast(config('TYPE.' . session('type_id')) . "को विवरण सच्याउन सफल भयो ", "success");
        return redirect()->back();
    }
}
