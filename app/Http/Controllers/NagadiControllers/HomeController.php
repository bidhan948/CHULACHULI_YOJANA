<?php

namespace App\Http\Controllers\NagadiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        session(['active_app' => 'nagadi']);
        return view('nagadi.home.index');
        // return redirect()->back
    }
}
