<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\ToleBikasSamitiSubmitRequest;
use App\Models\SharedModel\bank;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\setting\tole_bikas_samiti;
use App\Models\YojanaModel\setting\tole_bikas_samiti_detail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ToleBikasSamitiController extends Controller
{
    public function index(): View
    {
        return view('yojana.setting.tole_bikas_samiti.tole_bikas_samiti', [
            'tole_bikas_samitis' => tole_bikas_samiti::query()
                ->with('toleBikasSamitiDetails')
                ->get()
        ]);
    }

    public function create(): View
    {
        return view('yojana.setting.tole_bikas_samiti.create_tole_bikas_samiti', [
            'posts' => Setting::query()
                ->where('slug', config('SLUG.samiti_post'))
                ->with('settingValues', function ($q) {
                    $q->where('id', '!=', config('constant.TOLE_SAMYOJAK_ID'));
                })
                ->first(),
        ]);
    }

    public function store(ToleBikasSamitiSubmitRequest $request): RedirectResponse
    {
        $id =  DB::transaction(function () use ($request) {
            $regNo = tole_bikas_samiti::query()->count();
            $toleBikasSamiti = tole_bikas_samiti::create($request->except('detail_name', 'gender', 'cit_no', 'issue_district', 'contact_no') + [
                'reg_no' => $regNo + 1,
                'entered_by' => auth()->user()->id,
                'exp_date_eng' => convertBsToAd($request->exp_date_nep)
            ]);

            foreach ($request->position as $key => $position) {
                tole_bikas_samiti_detail::create([
                    'tole_bikas_samiti_id' => $toleBikasSamiti->id,
                    'position' => $position,
                    'name' => $request->detail_name[$key],
                    'ward_no' => $request->detail_ward_no[$key],
                    'gender' => $request->gender[$key],
                    'cit_no' => $request->cit_no[$key],
                    'issue_district' => $request->issue_district[$key],
                    'contact_no' => $request->contact_no[$key],
                ]);
            }

            return $toleBikasSamiti->id;
        });

        toast("टोल विकास समिति दर्ता सफल, दर्ता नं " . Nepali($id), "success");
        return redirect()->route('tole-bikas-samiti.index');
    }

    public function show(tole_bikas_samiti $tole_bikas_samiti): View
    {
        return view('yojana.setting.tole_bikas_samiti.show_tole_bikas_samiti', [
            'tole_bikas_samiti' => tole_bikas_samiti::query()
                ->where('id', $tole_bikas_samiti->id)
                ->with(['toleBikasSamitiDetails' => function ($q) {
                    $q->orderBy('id', 'ASC');
                }])
                ->first()
        ]);
    }

    public function edit(tole_bikas_samiti $tole_bikas_samiti): View
    {
        return view('yojana.setting.tole_bikas_samiti.edit_tole_bikas_samiti', [
            'posts' => Setting::query()
                ->where('slug', config('SLUG.samiti_post'))
                ->with('settingValues', function ($q) {
                    $q->where('id', '!=', config('constant.TOLE_SAMYOJAK_ID'));
                })
                ->first(),
            'tole_bikas_samiti' => tole_bikas_samiti::query()
                ->where('id', $tole_bikas_samiti->id)
                ->with(['toleBikasSamitiDetails' => function ($q) {
                    $q->orderBy('id', 'ASC');
                }])
                ->first()
        ]);
    }

    public function update(ToleBikasSamitiSubmitRequest $request, tole_bikas_samiti $tole_bikas_samiti): RedirectResponse
    {
        DB::transaction(function () use ($request, $tole_bikas_samiti) {
            $tole_bikas_samiti->update($request->except('detail_name', 'gender', 'cit_no', 'issue_district', 'contact_no') + [
                'exp_date_eng' => convertBsToAd($request->exp_date_nep)
            ]);

            tole_bikas_samiti_detail::query()->where('tole_bikas_samiti_id', $tole_bikas_samiti->id)->delete();

            foreach ($request->position as $key => $position) {
                tole_bikas_samiti_detail::create([
                    'tole_bikas_samiti_id' => $tole_bikas_samiti->id,
                    'position' => $position,
                    'name' => $request->detail_name[$key],
                    'ward_no' => $request->detail_ward_no[$key],
                    'gender' => $request->gender[$key],
                    'cit_no' => $request->cit_no[$key],
                    'issue_district' => $request->issue_district[$key],
                    'contact_no' => $request->contact_no[$key],
                ]);
            }
        });

        toast("टोल विकास समिति दर्ता सच्याउन सफल", "success");
        return redirect()->route('tole-bikas-samiti.show', ['tole_bikas_samiti' => $tole_bikas_samiti]);
    }

    public function print(tole_bikas_samiti $tole_bikas_samiti): View
    {
        return view('yojana.setting.tole_bikas_samiti.print_patra', ['tole_bikas_samiti' => $tole_bikas_samiti]);
    }

    public function bank(tole_bikas_samiti $tole_bikas_samiti): View
    {
        return view(
            'yojana.setting.tole_bikas_samiti.bank_tole_bikas_samiti',
            ['tole_bikas_samiti' => $tole_bikas_samiti->load('toleBikasSamitiDetails'), 'banks' => bank::query()->get()]
        );
    }

    public function printBank(Request $request, tole_bikas_samiti $tole_bikas_samiti)
    {
        if ($request->bank_id == '') {
            Alert::error("बैंक छान्नुहोस्");
            return redirect()->back();
        }
        return view('yojana.setting.tole_bikas_samiti.print_bank_tole_bikas_samiti', [
            'tole_bikas_samiti' => $tole_bikas_samiti->load('toleBikasSamitiDetails'), 'banks' => bank::query()->get(),
            'bank' => bank::query()->where('id', $request->bank_id)->first(),
            'date_nep' => $request->date_nep
        ]);
    }

    public function printPramanPatra(tole_bikas_samiti $tole_bikas_samiti): View
    {
        return view('yojana.setting.tole_bikas_samiti.print_praman_patra', ['tole_bikas_samiti' => $tole_bikas_samiti]);
    }
}
