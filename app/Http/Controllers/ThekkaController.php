<?php

namespace App\Http\Controllers;

use App\Models\YojanaModel\plan;
use Illuminate\Http\Request;

class ThekkaController extends Controller
{
    public function thekkaSuchanaDetail(plan $reg_no)
    {
        return view('yojana.thekka.thekka_suchana_detail',['plan' => $reg_no]);
    }
}
