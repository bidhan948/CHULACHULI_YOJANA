<?php

namespace App\Http\Controllers\YojanaControllers\setting;

use App\Helpers\Checker;
use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\AnugamanRequest;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\anugaman;
use App\Models\YojanaModel\anugaman_detail_plan;
use App\Models\YojanaModel\anugaman_plan;
use App\Models\YojanaModel\kul_lagat;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\anugaman_samiti;
use App\Models\YojanaModel\setting\anugaman_samiti_detail;
use App\Models\YojanaModel\type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AnugamanSamitiController extends Controller
{
    public function index(): View
    {
        return view('yojana.setting.anugaman_samiti.anugaman_samiti', [
            'anugaman_samitis' => anugaman_samiti::query()
                ->where('is_useable', 1)
                ->with('anugamanSamitiDetails')
                ->get()
        ]);
    }

    public function create(): View
    {
        return view('yojana.setting.anugaman_samiti.create_anungaman_samiti', [
            'posts' => Setting::query()
                ->where('slug', config('SLUG.samiti_post'))
                ->with('settingValues', function ($q) {
                    $q->where('id', config('constant.TOLE_SAMYOJAK_ID'))
                        ->orWhere('id', config('constant.TOLE_SADASYA_ID'));
                })
                ->first()
        ]);
    }

    public function store(AnugamanRequest $request): RedirectResponse
    {
        $anugaman = anugaman_samiti::query()
            ->where('anugaman_samiti_type_id', $request->anugaman_samiti_type_id)
            ->when($request->has('ward_no'), function ($q) use ($request) {
                $q->where('ward_no', $request->ward_no);
            })
            ->first();

        DB::transaction(function () use ($request, $anugaman) {
            if ($anugaman == null) {
                $anugaman = anugaman_samiti::create($request->except('ward_no', 'post_id', 'samiti_name') + [
                    'ward_no' => $request->has('ward_no') ? $request->ward_no : 0
                ]);
            }

            foreach ($request->post_id as $key => $post_id) {
                anugaman_samiti_detail::create([
                    'anugaman_samiti_id' => $anugaman->id,
                    'name' => $request->samiti_name[$key],
                    'post_id' => $post_id,
                    'gender' => $request->gender[$key],
                    'ward_no' => $request->ward_no,
                    'mobile_no' => $request->mobile_no[$key],
                ]);
            }
        });

        toast("अनुगमन समिति हाल्न सफल भयो", "success");
        return redirect()->back();
    }

    public function show(anugaman_samiti $anugaman_samiti): View
    {
        abort_if(!$anugaman_samiti->is_useable, 404);
        return view('yojana.setting.anugaman_samiti.show_anugaman_samiti', [
            'anugaman_samiti' => $anugaman_samiti->load('anugamanSamitiDetails')
        ]);
    }

    public function setStatus(anugaman_samiti_detail $anugaman_samiti_detail): RedirectResponse
    {
        $anugaman_samiti_detail->update(['status' => 0]);
        toast($anugaman_samiti_detail->name . " निस्क्रिय हुन सफल भयो", "success");
        return redirect()->back();
    }

    public function showAnugmanBibaran($regNo, YojanaHelper $helper)
    {
        $plan = plan::query()->where('reg_no', $regNo)->first();
        $kul_lagat = kul_lagat::query()->where('plan_id', $plan->id)->first();
        $type = type::query()->where('plan_id', $plan->id)->first();

        if ($kul_lagat == null || $type == null) {
            Alert::error("सम्पूर्ण फारम भरेर मात्र अगाडी बढ्नुहोला");
            return redirect()->back();
        } else {
            $anugaman_plan = anugaman_plan::query()
                ->where('plan_id', $plan->id)
                ->with('anugamanSamiti.anugamanSamitiDetails')
                ->first();

            $view = $anugaman_plan == null ? 'create-anugaman-samiti-plan' : 'edit-anugaman-samiti-plan';

            if (config('TYPE.AMANAT_MARFAT') != session('type_id')) {
                $relationName = $helper->getRelationNameViaSession(session('type_id'));
                $typeDetails = $type->typeable_type::query()
                            ->where('id',$type->typeable_id)
                            ->with($relationName,function($q){
                                $q->orderBy('id');
                            })
                            ->first();
            }
            return view('yojana.anugaman-samiti.' . $view, [
                'plan' => $plan,
                'kul_lagat' => $kul_lagat,
                'type' => $typeDetails ?? [],
                'regNo' => $regNo,
                'relationName' => $relationName ?? '',
                'anugaman_samitis' => anugaman_samiti::query()
                    ->with('anugamanSamitiDetails')
                    ->where('is_useable', 1)
                    ->get(),
                'anugaman_plan' => $anugaman_plan,
                'posts' => $helper->getPostViasSession(session('type_id'))
            ]);
        }
    }

    public function storeAnugmanBibaran(Request $request): RedirectResponse
    {
        if (!session()->has('type_id')) {
            Alert::error(config('YojanaMessage.SESSION_EXPIRED'));
            return redirect()->back();
        }
        $plan = plan::query()
            ->where('id', $request->plan_id)
            ->first();

        DB::transaction(function () use ($request) {
            if ($request->anugaman_samiti_id == '') {
                $anugaman_samiti = anugaman_samiti::create(['name' => $request->name, 'is_useable' => false]);

                foreach ($request->post_id as $key => $post_id) {
                    $anugaman_samiti_detail = anugaman_samiti_detail::create(
                        [
                            'post_id' => $post_id,
                            'name' => $request->samiti_name[$key],
                            'gender' => $request->gender[$key],
                            'mobile_no' => $request->mobile_no[$key],
                            'anugaman_samiti_id' => $anugaman_samiti->id,
                            'ward_no' => $request->ward_no[$key]
                        ]
                    );

                    anugaman_detail_plan::create(
                        [
                            'anugaman_samiti_detail_id' => $anugaman_samiti_detail->id,
                            'plan_id' => $request->plan_id,
                        ]
                    );
                }
            } else {
                $anugaman_samiti_details = anugaman_samiti_detail::query()
                    ->where('anugaman_samiti_id', $request->anugaman_samiti_id)
                    ->where('status', 1)
                    ->get();

                foreach ($anugaman_samiti_details as $key => $anugaman_samiti_detail) {
                    anugaman_detail_plan::create(
                        [
                            'anugaman_samiti_detail_id' => $anugaman_samiti_detail->id,
                            'plan_id' => $request->plan_id,
                        ]
                    );
                }
            }

            anugaman_plan::create([
                'plan_id' => $request->plan_id,
                'type_id' => session('type_id'),
                'anugaman_samiti_id' => $request->anugaman_samiti_id == '' ? $anugaman_samiti->id : $request->anugaman_samiti_id
            ]);
        });

        toast('अनुगमन समितिको विवरण हाल्न सफल भयो', 'success');
        return redirect()->route('plan.other_bibaran', ['reg_no' => $plan->reg_no]);
    }

    public function updateAnugmanBibaran(Request $request, anugaman_samiti $anugaman_samiti): RedirectResponse
    {
        $plan = plan::query()
        ->where('id',$request->plan_id)
        ->first();

        DB::transaction(function () use ($request, $anugaman_samiti) {
            if ($request->anugaman_samiti_id == '') {
                $anugaman_samiti->update(['name' => $request->name]);
                if ($request->has('post_id')) {
                    foreach ($request->post_id as $key => $post_id) {
                        $anugaman_samiti_detail = anugaman_samiti_detail::create(
                            [
                                'post_id' => $post_id,
                                'name' => $request->samiti_name[$key],
                                'gender' => $request->gender[$key],
                                'mobile_no' => $request->mobile_no[$key],
                                'anugaman_samiti_id' => $anugaman_samiti->id,
                                'ward_no' => $request->ward_no[$key]
                            ]
                        );

                        anugaman_detail_plan::create(
                            [
                                'anugaman_samiti_detail_id' => $anugaman_samiti_detail->id,
                                'plan_id' => $request->plan_id,
                            ]
                        );
                    }
                }
            } else {

                $anugaman_samiti_details = anugaman_samiti_detail::query()
                    ->where('anugaman_samiti_id', $anugaman_samiti->id)
                    ->where('status', 1)
                    ->get();

                foreach ($anugaman_samiti_details as $key => $anugaman_samiti_detail) {
                    anugaman_detail_plan::query()
                        ->where('plan_id', $request->plan_id)
                        ->where('anugaman_samiti_detail_id', $anugaman_samiti_detail->id)
                        ->delete();
                }

                $anugaman_samiti_details_to_be_inserted = anugaman_samiti_detail::query()
                    ->where('anugaman_samiti_id', $request->anugaman_samiti_id)
                    ->where('status', 1)
                    ->get();

                foreach ($anugaman_samiti_details_to_be_inserted as $key => $anugaman_samiti_inserted) {
                    anugaman_detail_plan::create(
                        [
                            'anugaman_samiti_detail_id' => $anugaman_samiti_inserted->id,
                            'plan_id' => $request->plan_id,
                        ]
                    );
                }
            }

            anugaman_plan::query()
                ->where('plan_id', $request->plan_id)
                ->where('type_id', session('type_id'))
                ->update(['anugaman_samiti_id' => $request->anugaman_samiti_id == '' ? $anugaman_samiti->id : $request->anugaman_samiti_id]);
        });

        toast('अनुगमन समितिको विवरण हाल्न सफल भयो', 'success');
        return redirect()->route('plan.other_bibaran', ['reg_no' => $plan->reg_no]);
    }
}
