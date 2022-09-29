<?php

namespace App\Http\Controllers\YojanaControllers\setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\AmanatRequest;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\kul_lagat;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\amanat;
use App\Models\YojanaModel\type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AmanatController extends Controller
{
    public function index($reg_no)
    {
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->first();
            
        $kul_lagat = kul_lagat::query()->where('plan_id', $plan->id)->first();
        if ($kul_lagat == null) {
            Alert::error("सम्पूर्ण फारम भरेर मात्र अगाडी बढ्नुहोला");
            return redirect()->back();
        } else {
            $amanat = amanat::query()
                ->where('plan_id', $plan->id)
                ->first();

            return view($amanat == null ? 'yojana.amanat.create_amanat' : 'yojana.amanat.edit_amanat', [
                'kul_lagat' => $kul_lagat,
                'plan' => $plan,
                'regNo' => $reg_no,
                'posts' => Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues')
                    ->first(),
                'amanat' => $amanat,
            ]);
        }
    }

    public function store(AmanatRequest $request): RedirectResponse
    {
        // checking here if session miss match or plan_id

        if (!kul_lagat::query()
            ->where('plan_id', $request->plan_id)
            ->where('type_id', session('type_id'))
            ->count()) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }

        DB::transaction(function () use ($request) {

            $amanat = amanat::create($request->validated());

            type::create(
                [
                    'typeable_id' => $amanat->id,
                    'typeable_type' => amanat::NAMESPACE,
                    'plan_id' => $request->plan_id,
                    'fiscal_year_id' => getCurrentFiscalYear(TRUE)->id
                ]
            );
        });

        toast(config('TYPE.' . session('type_id')) . " विवरण हाल्न सफल भयो ", "success");
        return redirect()->back();
    }

    public function update(AmanatRequest $request, amanat $amanat): RedirectResponse
    {
        // checking here if session miss match or plan_id

        if (!kul_lagat::query()
            ->where('plan_id', $request->plan_id)
            ->where('type_id', session('type_id'))
            ->count()) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }

        $amanat->update($request->validated());
        toast(config('TYPE.' . session('type_id')) . " विवरण सच्याउन सफल भयो ", "success");
        return redirect()->back();
    }
}
