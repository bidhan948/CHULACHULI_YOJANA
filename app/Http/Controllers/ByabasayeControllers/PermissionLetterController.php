<?php

namespace App\Http\Controllers\ByabasayeControllers;

use App\Http\Controllers\Controller;
use App\Models\SharedModel\Province;
use Illuminate\Http\Request;

class PermissionLetterController extends Controller
{
    public function index()
    {
        session(['active_app' => 'byabasaye']);
        return view('byabasaye.permission-letter.index');
        // return redirect()->back
    }
    public function create()
    {
        session(['active_app' => 'byabasaye']);
        $proviences = Province::get();
        return view('byabasaye.permission-letter.create', ['proviences' => $proviences]);
        // return redirect()->back
    }
    public function store()
    {
        session(['active_app' => 'byabasaye']);

        return redirect()->back();
    }
}
