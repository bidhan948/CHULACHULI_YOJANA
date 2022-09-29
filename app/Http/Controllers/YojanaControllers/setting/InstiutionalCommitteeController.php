<?php

namespace App\Http\Controllers\YojanaControllers\setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\InstitutionalCommitteRequest;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\kul_lagat;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\institutional_committee;
use App\Models\YojanaModel\setting\institutional_committee_detail;
use App\Models\YojanaModel\type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class InstiutionalCommitteeController extends Controller
{
    public function index($reg_no): View
    {
        $plan = plan::query()
        ->where('reg_no', $reg_no)
        ->first();
        $kul_lagat = kul_lagat::query()->where('plan_id', $plan->id)->first();
        if ($kul_lagat == null) {
            Alert::error("सम्पूर्ण फारम भरेर मात्र अगाडी बढ्नुहोला");
            return redirect()->back();
        } else {
            $institutional_committee = institutional_committee::query()
                ->where('plan_id', $plan->id)
                ->with('institutionalCommitteeDetail', function ($q) {
                    $q->orderBy('id');
                })
                ->first();

            return view($institutional_committee == null ? 'yojana.institutional_committe.create_institutional' : 'yojana.institutional_committe.edit_institutional', [
                'kul_lagat' => $kul_lagat,
                'plan' => $plan,
                'regNo' => $reg_no,
                'posts' => Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues')
                    ->first(),
                'institutional_committee' => $institutional_committee,
            ]);
        }
    }

    public function store(InstitutionalCommitteRequest $request): RedirectResponse
    {
        if (type::query()->where('plan_id', $request->plan_id)->count()) {
            Alert::error(config('YojanaMessage.CLIENT_ERROR'));
            return redirect()->back();
        }

        DB::transaction(function () use ($request) {

            $institutional_committee = institutional_committee::create($request->only('plan_id', 'name', 'ward_no'));

            foreach ($request->post_id as $key => $post_id) {
                institutional_committee_detail::create([
                    'institutional_committee_id' => $institutional_committee->id,
                    'post_id' => $post_id,
                    'name' => $request->fullname[$key],
                    'ward_no' => $request->ward_no_consumer[$key],
                    'gender' => $request->consumer_gender[$key],
                    'cit_no' => $request->cit_no[$key],
                    'issue_district' => $request->issue_district[$key],
                    'mobile_no' => $request->contact_no[$key],
                ]);
            }

            type::create(
                [
                    'typeable_id' => $institutional_committee->id,
                    'typeable_type' => institutional_committee::NAMESPACE,
                    'plan_id' => $request->plan_id,
                    'fiscal_year_id' => getCurrentFiscalYear(TRUE)->id
                ]
            );
        });

        toast(config('TYPE.3') . " विवरण हाल्न सफल भयो ", "success");
        return redirect()->back();
    }

    public function update(InstitutionalCommitteRequest $request,institutional_committee $institutional_committee) : RedirectResponse
    {
        DB::transaction(function () use ($request, $institutional_committee) {
            $institutional_committee->update($request->only('name', 'ward_no'));

            institutional_committee_detail::query()
                ->where('institutional_committee_id', $institutional_committee->id)
                ->forceDelete();

            foreach ($request->post_id as $key => $post_id) {
                institutional_committee_detail::create([
                    'institutional_committee_id' => $institutional_committee->id,
                    'post_id' => $post_id,
                    'name' => $request->fullname[$key],
                    'ward_no' => $request->ward_no_consumer[$key],
                    'gender' => $request->consumer_gender[$key],
                    'cit_no' => $request->cit_no[$key],
                    'issue_district' => $request->issue_district[$key],
                    'mobile_no' => $request->contact_no[$key],
                ]);
            }
        });

        toast(config('TYPE.3'). " विवरण सच्याउन सफल भयो ", "success");
        return redirect()->back();
    }
}
