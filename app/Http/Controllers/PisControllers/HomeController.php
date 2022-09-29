<?php

namespace App\Http\Controllers\PisControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        session(['active_app' => 'pis']);
        return view('pis.home.index');
        // return redirect()->back
    }
}
