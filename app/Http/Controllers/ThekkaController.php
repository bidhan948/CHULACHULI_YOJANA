<?php

namespace App\Http\Controllers;

use App\Http\Requests\YojanaRequest\ContractRequest;
use App\Http\Requests\YojanaRequest\ThekkaOpenRequest;
use App\Models\YojanaModel\contract;
use App\Models\YojanaModel\contractOpen;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\list_registration;
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
    
    public function thekkaOpenForm($reg_no)
    {
        $plan = plan::query()->where('reg_no',$reg_no)->with('contractOpens')->first();

        if (count($plan->contractOpens)!=0) {
            return view('yojana.thekka.edit_thekka_open_form',['plan' => $plan, 'list_registrations' => list_registration::query()->where('name','निर्माण व्यवसाय')->with('listRegistrationAttribute.listRegistrationAttributeDetails')->first()]);
        }
        return view('yojana.thekka.create_thekka_open_form',['plan' => $plan, 'list_registrations' => list_registration::query()->where('name','निर्माण व्यवसाय')->with('listRegistrationAttribute.listRegistrationAttributeDetails')->first()]);
    }
    
    public function thekkaOpenSubmit(ThekkaOpenRequest $request)
    {
        // dd($request->all());
        foreach ($request->name as $key => $value) {
            contractOpen::create([
                'plan_id' => $request->plan_id,
                'name' => $request ->name[$key],
                'bank_name' => $request->bank_name[$key],
                'bank_guarantee_amount' => $request->bank_guarantee_amount[$key],
                'bank_date' => $request->bank_date[$key],
                'bail_amount' => $request->bail_amount[$key],
                'remark' => $request->remark[$key],
            ]);
        }
        toast("ठेक्का सुचना विवरण हाल्न सफल भयो", 'success');
        return redirect()->back();
        // contractOpen::create($re)
    }

    public function thekkaKabol($reg_no)
    {
        $plan = plan::query()->where('reg_no',$reg_no)->with('contractOpens')->first();
        return view('yojana.thekka.create_thekka_kabol',['plan' => $plan]);
    }

    
    
}
