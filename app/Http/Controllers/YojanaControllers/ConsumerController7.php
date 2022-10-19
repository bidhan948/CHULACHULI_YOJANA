<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Helpers\Checker;
use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\ConsumerRequest;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\consumer;
use App\Models\YojanaModel\consumer_detail;
use App\Models\YojanaModel\kul_lagat;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\tole_bikas_samiti;
use App\Models\YojanaModel\type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ConsumerController extends Controller
{
    public function index($reg_no)
    {
        dd($reg_no);
        $plan = plan::query()
            ->where('reg_no', $reg_no)
            ->first();
        $kul_lagat = kul_lagat::query()->where('plan_id', $plan->id)->first();
        if ($kul_lagat == null) {
            Alert::error("सम्पूर्ण फारम भरेर मात्र अगाडी बढ्नुहोला");
            return redirect()->back();
        } else {
            $consumer = consumer::query()
                ->where('plan_id', $plan->id)
                ->with('consumerDetails', function ($q) {
                    $q->orderBy('id');
                })
                ->first();

            return view($consumer == null ? 'yojana.consumer.create_consumer_bibaran' : 'yojana.consumer.edit_consumer_bibaran', [
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
                'consumer' => $consumer,
                'tole_bikas_samitis' => tole_bikas_samiti::query()
                    ->with('toleBikasSamitiDetails')
                    ->get()
            ]);
        }
    }

    public function store(ConsumerRequest $request, Checker $checker): RedirectResponse
    {
        if ($checker->checkFemalePercent($request->consumer_gender)) {
            Alert::error('३३ % महिलाको संख्या पुगेन |');
            return redirect()->back();
        }

        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->first();

        DB::transaction(function () use ($request) {
            $consumer = consumer::create($request->only('plan_id', 'name', 'ward_no') + ['entered_by' => auth()->user()->id]);

            foreach ($request->post_id as $key => $post_id) {
                consumer_detail::create([
                    'consumer_id' => $consumer->id,
                    'post_id' => $post_id,
                    'name' => $request->fullname[$key],
                    'ward_no' => $request->ward_no_consumer[$key],
                    'gender' => $request->consumer_gender[$key],
                    'cit_no' => $request->cit_no[$key],
                    'issue_district' => $request->issue_district[$key],
                    'contact_no' => $request->contact_no[$key],
                ]);
            }

            type::create([
                'typeable_id' => $consumer->id,
                'typeable_type' => consumer::NAMESPACE,
                'plan_id' => $request->plan_id,
                'fiscal_year_id' => getCurrentFiscalYear(TRUE)->id
            ]);
        });

        toast("उपभोक्ता समिति विवरण हाल्न सफल भयो ", "success");
        return redirect()->route('plan.anugaman', ['reg_no' => $plan->reg_no]);
    }

    public function update(ConsumerRequest $request, consumer $consumer, Checker $checker): RedirectResponse
    {
        if ($checker->checkFemalePercent($request->consumer_gender)) {
            Alert::error('३३ % महिलाको संख्या पुगेन |');
            return redirect()->back();
        }
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->first();
        DB::transaction(function () use ($request, $consumer) {
            $consumer->update($request->only('name', 'ward_no'));

            consumer_detail::query()
                ->where('consumer_id', $consumer->id)
                ->forceDelete();

            foreach ($request->post_id as $key => $post_id) {
                consumer_detail::create([
                    'consumer_id' => $consumer->id,
                    'post_id' => $post_id,
                    'name' => $request->fullname[$key],
                    'ward_no' => $request->ward_no_consumer[$key],
                    'gender' => $request->consumer_gender[$key],
                    'cit_no' => $request->cit_no[$key],
                    'issue_district' => $request->issue_district[$key],
                    'contact_no' => $request->contact_no[$key],
                ]);
            }
        });

        toast("उपभोक्ता समिति विवरण सच्याउन सफल भयो ", "success");
        return redirect()->route('plan.anugaman', ['reg_no' => $plan->reg_no]);
    }
}
