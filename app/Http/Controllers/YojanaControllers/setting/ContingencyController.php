<?php

namespace App\Http\Controllers\YojanaControllers\setting;

use App\Http\Controllers\Controller;
use App\Models\YojanaModel\setting\contingency;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContingencyController extends Controller
{
    public function index(): View
    {
        return view('yojana.setting.contingency', [
            'contingency' => contingency::query()
                ->where('fiscal_year_id', getCurrentFiscalYear(true)->id)
                ->latest()
                ->first()
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate(['percent' => 'required']);
        $contingency = contingency::query()
            ->where('fiscal_year_id', getCurrentFiscalYear(true)->id)
            ->first();

        if ($contingency == null) {
            contingency::create($validate + ['fiscal_year_id' => getCurrentFiscalYear(true)->id]);
            toast("कन्टेन्जेन्सी कट्टी प्रतिसत हाल्न सफल भयो", "success");
        } else {
            Alert::error("कन्टेन्जेन्सी कट्टी प्रतिसत हालिसकेको छ");
        }

        return redirect()->back();
    }

    public function update(Request $request, contingency $contingency): RedirectResponse
    {
        $validate = $request->validate(['percent' => 'required']);
        $contingency->update($validate);
        toast("कन्टेन्जेन्सी कट्टी प्रतिसत सच्याउन सफल भयो", "success");
        return redirect()->back();
    }
}
