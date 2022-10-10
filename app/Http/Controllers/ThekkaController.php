<?php

namespace App\Http\Controllers;

use App\Http\Requests\YojanaRequest\ContractRequest;
use App\Models\YojanaModel\contract;
use App\Models\YojanaModel\plan;
use Illuminate\Http\Request;

class ThekkaController extends Controller
{

    public function thekkaSuchanaDetail(plan $reg_no)
    {
        $contract = contract::query()->where('plan_id',$reg_no->id)->first();
        return view('yojana.thekka.thekka_suchana_detail', ['plan' => $reg_no,'contract'=> $contract]);
    }

    public function thekkaSuchanaDetailSubmit(ContractRequest $request)
    {
        $contract = contract::query()->where('plan_id',$request->plan_id)->first();

        if ($contract==null) {
            contract::create($request->except('_token'));
            toast("ठेक्का सुचना विवरण हाल्न सफल भयो", 'success');
        }
        else{
            $contract->update($request->except('_token'));
            toast("ठेक्का सुचना विवरण सच्याउन सफल भयो", 'success');
        }
        return redirect()->back();
    }
    
}
