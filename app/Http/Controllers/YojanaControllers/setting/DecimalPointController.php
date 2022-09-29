<?php

namespace App\Http\Controllers\YojanaControllers\setting;

use App\Http\Controllers\Controller;
use App\Models\SharedModel\FiscalYear;
use App\Models\YojanaModel\setting\decimal_point;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DecimalPointController extends Controller
{
    public function index()
    {
        return view('yojana.setting.decimal_point', [
            'decimal_points' => decimal_point::query()->get(),
            'fiscal_years' => FiscalYear::query()->get()
        ]);
    }

    public function store(Request $request)
    {
        $attribute = $request->validate(['name' => 'required', 'fiscal_year_id' => 'required']);

        if (decimal_point::query()->where('fiscal_year_id', $request->fiscal_year_id)->count()) {
            toast("निम्न आर्थिक बर्षमा decimal point हलिसक्या छ", "error");
            return redirect()->back();
        }

        decimal_point::create($attribute);
        toast("निम्न आर्थिक बर्षमा decimal point हाल्न सफल भयो", "success");
        return redirect()->back();
    }

    public function update(Request $request, decimal_point $decimal_point): RedirectResponse
    {
        $attribute = $request->validate(['name' => 'required', 'fiscal_year_id' => 'required']);

        if (decimal_point::query()
            ->where('fiscal_year_id', $request->fiscal_year_id)
            ->where('id', '!=', $decimal_point->id)
            ->count()
        ) {
            toast("निम्न आर्थिक बर्षमा decimal point हलिसक्या छ", "error");
            return redirect()->back();
        }

        $decimal_point->update($attribute);
        toast("निम्न आर्थिक बर्षमा decimal point सच्याउन सफल भयो", "success");
        return redirect()->back();
    }
}
