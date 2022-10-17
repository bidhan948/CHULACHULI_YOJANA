<?php

namespace App\Http\Controllers;

use App\Http\Requests\YojanaRequest\ContractRequest;
use App\Http\Requests\YojanaRequest\ThekkaKabolRequest;
use App\Http\Requests\YojanaRequest\ThekkaOpenRequest;
use App\Models\YojanaModel\contract;
use App\Models\YojanaModel\contractKabol;
use App\Models\YojanaModel\contractOpen;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\list_registration;
use Illuminate\Http\Request;
use App\Models\SharedModel\Setting;
use App\Models\SharedModel\SettingValue;
use App\Models\YojanaModel\contractKulLagat;

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

        $contractOpen = contractOpen::query()->where('plan_id',$plan->id)->get();
        $contractKabol = contractKabol::query()->where('plan_id',$plan->id)->get();
        
        if (count($contractOpen)==0) {
            toast("ठेक्का सुचना विवरण हालिएको छैन", 'error');
            return redirect()->back();
        }

        if (count($contractKabol)>0) {
            return view('yojana.thekka.edit_thekka_kabol',['plan' => $plan,'contract_open'=> $contractOpen,'contractKabol' => $contractKabol]);
        }
        return view('yojana.thekka.create_thekka_kabol',['plan' => $plan,'contract_open'=> $contractOpen]);
    }
    
    public function thekkaKabolSubmit(ThekkaKabolRequest $request)
    {
        $contractKabol = contractKabol::query()->where('plan_id',$request->plan_id)->get();
        if (count($contractKabol)>0) {
            foreach ($contractKabol as $key => $value) {
                $value->delete();
            }
        }
        foreach ($request->contractor_name as $key => $value) {
           contractKabol::create([
            'plan_id' => $request->plan_id,
            'contractor_name' => $request->contractor_name[$key],
            'has_vat' => $request->has_vat[$key],
            'total_kabol_amount' => $request->total_kabol_amount[$key],
            'total_amount' => $request->total_amount[$key],
            'bank_guarantee' => $request->bank_guarantee_amount[$key],
            'bail_account_amount' => $request->bail_account_amount[$key],
           ]);
          
        }
        toast("ठेक्का कबोल सुचना हाल्न सफल भयो", 'success');
        return redirect()->back();
    }

    public function thekkaboli($reg_no)
    {
        $plan = plan::query()->where('reg_no',$reg_no)->with('contractOpens','contractKabols')->first();
        return view('yojana.thekka.create_thekka_bol',[
            'plan' => $plan
        ]);

    }

    public function thekkaBoliSubmit(Request $request)
    {
        $request->validate([
            'kabol_id' => 'required',
            'date' => 'required'
        ]);
        $contractKabol = contractKabol::query()->where('id',$request->kabol_id)->with('plan','contract')->first();
        $contractKabol->update([
            'is_selected' => 1,
            'date' => $request->date
        ]);
        $unit_id = Setting::query()->where('slug', 'setup_unit')->first();

        $units = SettingValue::query()->where('setting_id', $unit_id->id)->get();


        return view('yojana.thekka.thekka_kul_lagat',[
            'contract_kabol' => $contractKabol,
            'units' => $units
        ]);
    }

    public function thekkaKulLagatSubmit(Request $request)
    {
        
        $plan = plan::query()->where('id',$request->plan_id)->first();
        

        $request->validate([
            'physical_amount' => 'required',
            'unit_id' => 'required'
        ]);

        contractKulLagat::create($request->except('_token'));
        return view('yojana.thekka.create_thekka_run_detail',[
            'plan' => $plan
        ]);

    }


    

    
    
}
