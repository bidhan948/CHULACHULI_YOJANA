<?php

namespace App\Http\Controllers\ByabasayeControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        session(['active_app' => 'byabasaye']);
        return view('byabasaye.home.index');
        // return redirect()->back
    }
}
