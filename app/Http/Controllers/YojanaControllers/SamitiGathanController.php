<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\anugaman_samiti;
use App\Models\YojanaModel\setting\tole_bikas_samiti;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SamitiGathanController extends Controller
{
    const SLUG_ARRAY = ['tole-bikas-samiti', 'anugaman-samiti'];

    public function index(): View
    {
        return view('yojana.samiti_gathan', [
            'tole_bikas_count' => tole_bikas_samiti::query()->count(),
            'anugaman_samiti_count' => anugaman_samiti::query()->where('is_useable', 1)->count()
        ]);
    }

    public function planOperateDashboard(): View
    {
        return view('yojana.plan_operate');
    }

    public function searchPlan($slug): View
    {
        abort_if(!in_array($slug, config('TYPE.SLUG')), 404);
        return view('yojana.search_plan.search_plan', [
            'slug' => $slug,
            'type_id' => config('TYPE.' . $slug)
        ]);
    }

    public function searchPlanByRegno(Request $request)
    {
        if ($request->reg_no == '') {
            Alert::error("योजनाको दर्ता नं अनिवार्य छ");
        } else {
            $plan = plan::query()
                ->where('reg_no', English($request->reg_no))
                ->where('type_id',config('YOJANA.PLAN'))
                ->with('Parents', 'planOperate')
                ->first();
            if ($plan == null) {
                Alert::error("योजनाको दर्ता नं भेटिएन");
            } else {
                if ($plan->Parents->count() > 0) {
                    Alert::error("यो योजनाको टुक्रीसकेको छ");
                } else {
                    if ($plan->is_merge) {
                        Alert::error(config('YojanaMessage.MERGE_ERROR'));
                        return redirect()->back();
                    }
                    abort_if(!in_array($request->type_id, config('TYPE.TYPE_ARRAY')), 404);
                    if ($plan->planOperate != null) {
                        if ($plan->planOperate->type_id == $request->type_id) {
                            session(['type_id' => $request->type_id]);
                        } else {
                            Alert::error($plan->name . ' योजना ' . config('TYPE.' . $plan->planOperate->type_id) . 'बाट संचालन भैसकेको छ');
                            return redirect()->back();
                        }
                    }
                    $ward_no = auth()->user()->ward_no;
                    session(['type_id' => $request->type_id]);
                    if(!$ward_no){
                        return view('yojana.search_plan.dashboard', [
                            'reg_no' => English($request->reg_no),
                            'plan' => $plan
                        ]);
                    }else{
                        if($plan->planWardDetails == null){
                            Alert::error('संचालन हुने वार्ड अनिवार्य छ');
                            return redirect()->back();
                        }else{
                            $planWardDetails = $plan->planWardDetails;
                            // dd($planWardDetails->contains($ward_no,'ward_no'));
                        if($planWardDetails->contains('ward_no',$ward_no)){
                            return view('yojana.search_plan.dashboard', [
                                'reg_no' => English($request->reg_no),
                                'plan' => $plan
                            ]);
                            }else{
                                Alert::error('निम्न योजना अर्कै वार्ड बाट संचालन भैसकेको छ ');
                                return redirect()->back();
                            }
                        }
                    }
                }
            }
        }
        return redirect()->back();
    }

    public function programOperateDashboard()
    {
        return view('yojana.program.search_program');
    }

    public function searchProgramByRegno(Request $request)
    {
        if ($request->reg_no == '') {
            Alert::error("कार्यक्रम दर्ता नं अनिवार्य छ");
        } else {
            $program = plan::query()
                ->where('reg_no', English($request->reg_no))
                ->first();

            if ($program == null) {
                Alert::error("कार्यक्रम दर्ता नं भेटिएन");
            } else {
                if ($program->type_id == config('YOJANA.PROGRAM')) {
                    return view('yojana.program.dashboard', [
                        'reg_no' => English($request->reg_no),
                        'program' => $program
                    ]);
                } else {
                    Alert::error('निम्न दर्ता नं योजना अन्तर्गत भएकाले यसलाई योजना संचालन प्रकिया बाट चलाउनुहोस');
                }
            }
        }
        return redirect()->back();
    }
}
