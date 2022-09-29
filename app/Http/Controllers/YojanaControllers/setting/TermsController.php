<?php

namespace App\Http\Controllers\YojanaControllers\setting;

use App\Http\Controllers\Controller;
use App\Models\YojanaModel\setting\term;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TermsController extends Controller
{
    public function index(): View
    {
        return view('yojana.setting.term', [
            'terms' => term::query()->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attribute = $request->validate(['type_id' => 'required|unique:terms,type_id', 'term' => 'required']);
        term::create($attribute);
        toast("शर्तहरु हाल्न सफल भयो", "success");
        return redirect()->back();
    }

    public function update(Request $request,term $term): RedirectResponse
    {
        $attribute = $request->validate(['term' => 'required']);
        $term->update($attribute);
        toast('शर्तहरु सच्याउन सफल भयो','success');
        return redirect()->back();
    }
}
