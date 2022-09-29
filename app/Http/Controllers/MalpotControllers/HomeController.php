<?php

namespace App\Http\Controllers\MalpotControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        session(['active_app' => 'malpot']);
        return view('malpot.home.index');
        // return redirect()->back
    }
}
