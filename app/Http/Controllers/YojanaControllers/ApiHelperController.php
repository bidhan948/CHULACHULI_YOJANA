<?php

namespace App\Http\Controllers\YojanaControllers;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Models\PisModel\StaffService;
use App\Models\SharedModel\bank;
use App\Models\SharedModel\SettingValue;
use App\Models\YojanaModel\budget_source_plan;
use App\Models\YojanaModel\BudgetSource;
use App\Models\YojanaModel\kul_lagat;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\program\program_add_deadline;
use App\Models\YojanaModel\program\program_advance;
use App\Models\YojanaModel\program\program_final_payment;
use App\Models\YojanaModel\program\work_order;
use App\Models\YojanaModel\running_bill_payment;
use App\Models\YojanaModel\setting\anugaman_samiti;
use App\Models\YojanaModel\setting\anugaman_samiti_detail;
use App\Models\YojanaModel\setting\list_registration;
use App\Models\YojanaModel\setting\list_registration_attribute;
use App\Models\YojanaModel\setting\tole_bikas_samiti;
use App\Models\YojanaModel\setting\tole_bikas_samiti_detail;
use App\Models\YojanaModel\type;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class ApiHelperController extends Controller
{
    public function getBudgetSourceAmount()
    {
        $data['budget_source_amount'] = $budget_source_amount = BudgetSource::query()
            ->withSum(['budget_source_deposit as amount' => function ($query) {
                $query->where('fiscal_year_id', getCurrentFiscalYear(TRUE)->id);
            }], 'amount')
            ->where('id', request('budget_source_id'))
            ->withSum(['budget_source_plan as amountToBeSubtracted' => function ($query) {
                $query->where('is_split', 0)->where('is_merge', 0);
            }], 'amount')
            ->first();
        $actual_amount = $budget_source_amount->amount - ($budget_source_amount->amountToBeSubtracted ?? 0);

        $html = '<tr id="tr_' . $budget_source_amount->id . '"><td class="text-center"><input type="text" class="form-control form-control-sm" name="budget_source_name[]" value="' . $budget_source_amount->name . '" readonly></td>';
        $html .= '<td class="text-center"><input type="number" id="amount_' . $budget_source_amount->id . '" onkeyup="calculateBakiAmount(' . $budget_source_amount->id . ')" step="0.1" class="form-control form-control-sm amount" name="rakam[' . $budget_source_amount->id . ']"></td>';
        $html .= '<td class="text-center"><input class="form-control form-control-sm" id="jamma_' . $budget_source_amount->id . '" value="' . $actual_amount . '" disabled></td>';
        $html .= '<td class="text-center"><input class="form-control form-control-sm" id="baki_' . $budget_source_amount->id . '" readonly></td><input type="hidden" class="budget_source_id" name="budget_source_id[]" value="' . $budget_source_amount->id . '">';
        $html .= '<td class="text-center"><span class="btn btn-danger btn-sm" onclick="removeTR(' . $budget_source_amount->id . ')"><i class="fa-solid fa-circle-xmark"></i></span></td>';
        $data['html'] = $html;
        return response()->json($data, 200);
    }

    public function getTopicAreaType()
    {
        $data['topic_area_types'] = $topic_area_types = SettingValue::query()
            ->where('cascading_parent_id', request('setting_id'))
            ->whereNotNull('cascading_parent_id')
            ->get();
        $html = '<option value="">--छान्नुहोस्--</option>';
        foreach ($topic_area_types as $topic_area_type) {
            $html .= '<option value="' . $topic_area_type->id . '">' . $topic_area_type->name . '</option>';
        }

        $data['html'] = $html;
        return response()->json($data);
    }

    public function getBankName()
    {
        return response()->json(bank::query()->where('id', request('bankId'))->first());
    }

    public function getToleBikasSamitiDetail()
    {
        $html = '';
        $tole_bikas_samiti_details = tole_bikas_samiti_detail::query()
            ->where('tole_bikas_samiti_id', request('tole_bikas_samiti_id'))
            ->get();
        foreach ($tole_bikas_samiti_details as $tole_bikas_samiti_detail) {
            $html .= '<tr><td class="text-center"><input class="form-control form-control-sm" disabled required value="' . getSettingValueById($tole_bikas_samiti_detail->position)->name . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->name . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->ward_no . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->gender . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->cit_no . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->issue_district . '"></td>';
            $html .= '<td class="text-center"><input class="form-control form-control-sm" disabled required value="' . $tole_bikas_samiti_detail->contact_no . '"></td></tr>';
        }
        return response()->json($html);
    }


    public function getAnugmanSamiti()
    {
        $html = '';
        $anugaman_samiti = anugaman_samiti::query()
            ->where('anugaman_samiti_type_id', request('anugaman_samiti_type_id'))
            ->when(request('ward_no') && request('anugaman_samiti_type_id') != 1, function ($q) {
                $q->where('ward_no', request('ward_no'));
            })
            ->with('anugamanSamitiDetails', function ($q) {
                $q->where('status', 1);
            })
            ->first();

        if ($anugaman_samiti != null) {
            foreach ($anugaman_samiti->anugamanSamitiDetails as $key => $anugaman_samiti_detail) {
                $html .= '<tr class="dummy"><td class="text-center"><input type="text" class="form-control form-control-sm" value="' . getSettingValueById($anugaman_samiti_detail->post_id)->name . '" disabled></td>';
                $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->name . '" disabled></td>';
                $html .= '<td class="text-center" style="width:10%;"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->ward_no . '" disabled></td>';
                $html .= '<td class="text-center" style="width:10%;"><input type="text" class="form-control form-control-sm" value="' . returnGender($anugaman_samiti_detail->gender) . '" disabled></td>';
                $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->mobile_no . '" disabled></td>';
                $html .= '<td class="text-center"><a href="' . route("anugaman.setStatus", $anugaman_samiti_detail) . '" class="btn btn-sm btn-primary">निष्क्रिय गर्नुहोस्</a></td></tr>';
            }
        }
        return response()->json($html);
    }

    public function getAnugmanSamitiById()
    {
        $html = '';
        $anugaman_samiti_detail = anugaman_samiti_detail::query()
            ->where('anugaman_samiti_id', request('anugaman_samiti_id'))
            ->get();

        if ($anugaman_samiti_detail->count()) {
            foreach ($anugaman_samiti_detail as $anugaman_samiti_detail) {
                $html .= '<tr class="dummy"><td class="text-center"><input type="text" class="form-control form-control-sm" value="' . getSettingValueById($anugaman_samiti_detail->post_id)->name . '" disabled></td>';
                $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->name . '" disabled></td>';
                $html .= '<td class="text-center" style="width:10%;"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->ward_no . '" disabled></td>';
                $html .= '<td class="text-center" style="width:10%;"><input type="text" class="form-control form-control-sm" value="' . returnGender($anugaman_samiti_detail->gender) . '" disabled></td>';
                $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm" value="' . $anugaman_samiti_detail->mobile_no . '" disabled></td></tr>';
            }
        }
        return response()->json($html);
    }

    public function getPostByStaffId()
    {
        if (request('staff_id') == '') {
            return response()->json();
        }

        $staffService = StaffService::query()->where('user_id', request('staff_id'))->first();
        if ($staffService != NULL) {
            return response()->json(
                [
                    'post' => getSettingValueById($staffService->position)->name,
                    'post_id' => $staffService->position
                ]
            );
        }
    }

    public function getChildRole()
    {
        $html = '';
        $roles = Role::query()
            ->where('role_id', request('role_id'))
            ->get();
        $html .=  '<div class="input-group input-group-sm mb-3">';
        $html .= '<div class="input-group-prepend">';
        $html .= '<span class="input-group-text">भूमिका<span class="text-dnager px-1 font-weight-bold text-danger">*</span></span></div>';
        $html .= '<select name="role_id[]" class="form-control" id="child_role">';
        $html .= '<option value="">--छान्नुहोस्--</option>';
        foreach ($roles as $key => $role) {
            $html .= '<option value="' . $role->id . '">' . $role->name . '</option>';
        }
        $html .= '</select></div>';

        return response()->json($html);
    }

    public function getRawSuchiDartField(YojanaHelper $helper)
    {
        $html = '';

        $list_registration_attribute = list_registration_attribute::query()
            ->where('id', request('list_registration_attribute'))
            ->with('listRegistrationAttributeDetails')
            ->first();

        switch (request('list_registration_id')) {

            case config('YOJANA.LIST_REGISTRATION.FORM_COMPANY'):
                $html = view('yojana.setting.list_registration_include.form_company', [
                    'list_registration_attribute' => $list_registration_attribute
                ])->render();
                break;
            case config('YOJANA.LIST_REGISTRATION.KARMACHARI'):
                $html = view('yojana.setting.list_registration_include.karmachari', [
                    'list_registration_attribute' => $list_registration_attribute
                ])->render();
                break;
            case config('YOJANA.LIST_REGISTRATION.SANSTHA'):
                $html = view(
                    'yojana.setting.list_registration_include.sanstha',
                    [
                        'posts' => $helper->getPostViasSession(config('TYPE.SANSTHA_SAMITI')),
                        'list_registration_attribute' => $list_registration_attribute
                    ]
                )->render();
                break;
            case config('YOJANA.LIST_REGISTRATION.ANYA_SAMUHA'):
                $html = view(
                    'yojana.setting.list_registration_include.anya_samuha',
                    [
                        'posts' => $helper->getPostViasSession(config('TYPE.SANSTHA_SAMITI')),
                        'list_registration_attribute' => $list_registration_attribute
                    ]
                )->render();
                break;
            case config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI'):
                $html = view(
                    'yojana.setting.list_registration_include.upabhokta_samiti',
                    [
                        'posts' => $helper->getPostViasSession(config('TYPE.SANSTHA_SAMITI')),
                        'list_registration_attribute' => $list_registration_attribute
                    ]
                )->render();
                break;
            case config('YOJANA.LIST_REGISTRATION.PADADHIKARI'):
                $html = view('yojana.setting.list_registration_include.padadhikari', [
                    'list_registration_attribute' => $list_registration_attribute
                ])->render();
                break;
            case config('YOJANA.LIST_REGISTRATION.BYAKTI'):
                $html = view('yojana.setting.list_registration_include.byakti', [
                    'list_registration_attribute' => $list_registration_attribute
                ])->render();
                break;
            case config('YOJANA.LIST_REGISTRATION.NIRMAN_BEBASAYA'):
                $html = view('yojana.setting.list_registration_include.nirman_bebasaya', [
                    'list_registration_attribute' => $list_registration_attribute
                ])->render();
                break;
            default:
                $html = "";
                break;
        }
        return response()->json($html);
    }


    public function getSuchiDartaBibaran()
    {
        $list_registration_attributes = list_registration_attribute::query()
            ->where('list_registration_id', request('list_registration_id'))
            ->get();
        $html = '';

        foreach ($list_registration_attributes as $key => $list_registration_atrribute) {
            $html .= '<tr>';
            $html .= '<td class="text-center">' . Nepali($key + 1) . '</td>';
            $html .= '<td class="text-center">' . $list_registration_atrribute->name . '</td>';
            $html .= '<td class="text-center">';
            $html .= ($list_registration_atrribute->list_registration_id == config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI') ? config('constant.SITE_NAME') . ' ' . Nepali($list_registration_atrribute->ward_no) : $list_registration_atrribute->address) . '</td>';
            $html .= '<td class="text-center"><a class="btn btn-sm btn-warning mx-1" href="' . route('setting.list_registration_fullBibaranShow', $list_registration_atrribute) . '"><i class="fa-solid fa-id-card px-1"></i>पुरा बिबरण हेर्नुहोस्</a>';
            $html .= '<a class="btn btn-sm btn-primary mx-1" href="' . route('setting.list_registration_edit', $list_registration_atrribute) . '"><i class="fa-solid fa-pen-to-square px-1"></i>सच्याउनुहोस्</a></td>';
            $html .= '</tr>';
        }

        return response()->json($html);
    }

    public function getSubListRegistration()
    {
        $html = '';

        $list_registration_atrributes = list_registration_attribute::query()
            ->where('list_registration_id', request('list_registration_id'))
            ->get();

        $html .= '<div class="form-group mt-2">';
        $html .= '<div class="input-group input-group-sm">';
        $html .= '<div class="input-group-prepend">';
        $html .= '<span class="input-group-text">नाम';
        $html .= '<span class="text-danger font-weight-bold px-1">*</span></span></div>';
        $html .= '<select name="list_registration_attribute_id" id="list_registration_attribute_id"class="form-control form-control-sm" required>';
        $html .= '  <option value="">--छान्नुहोस्--</option>';
        foreach ($list_registration_atrributes as $list_registration_attribute) {
            $html .= '<option value="' . $list_registration_attribute->id . '">' . $list_registration_attribute->name . '</option>';
        }
        $html .= '</select></div></div>';

        return response()->json($html);
    }

    public function getWorkOrderById()
    {
        return response()->json(work_order::query()
            ->select('id', 'work_order_no', 'name')
            ->where('id', request('work_order_id'))
            ->first());
    }

    public function getPlanName()
    {
        return response()->json(plan::query()
            ->select('id', 'reg_no', 'name', 'grant_amount')
            ->where('reg_no', request('reg_no'))
            ->where('type_id', config('YOJANA.PLAN'))
            ->whereDoesntHave('Parents')
            ->when(request('merge_type'), function ($q) {
                $q->whereHas('kulLagat');
            })
            ->when(!request('merge_type'), function ($q) {
                $q->whereDoesntHave('kulLagat');
            })
            ->where('is_merge', false)
            ->whereDoesntHave('mergePlan')
            ->get()
            ->map(function ($value, $key) {
                return [
                    'id' => $value->id,
                    'reg_no' => $value->reg_no,
                    'name' => $value->name,
                    'grant_amount' => Nepali($value->grant_amount),
                ];
            }));
    }

    public function getAmountByworkOrderId()
    {
        return response()->json(work_order::query()->where('id', request('work_order_id'))->first());
    }

    public function getPeriodByWorkOrderNo()
    {
        $program_add_deadlines = program_add_deadline::query()
            ->where('work_order_id', request('work_order_id'))
            ->with('workOrder')
            ->get();

        $workOrder = work_order::query()->where('id', request('work_order_id'))->first();

        $html = '<span><span class="font-weight-bold ">तोकिएको सम्पन्न मिति :</span> ' . Nepali($workOrder->program_end_date_nep) . '</span> <br>';

        foreach ($program_add_deadlines as $program_add_deadline) {
            $html .= '<span class="my-1"><span class="font-weight-bold ">' . convertNumberToNepaliWord($program_add_deadline->period) . 'म्याद थप अबधि:</span>' . Nepali($program_add_deadline->period_add_date_nep) . '<a class="btn btn-sm btn-primary mx-1 my-1" href="' . route('program.add_deadline.edit', $program_add_deadline) . '"><i class="fa-solid fa-eye"></i></a></span><br>';
        }
        $data['html'] = $html;
        $data['period'] = $program_add_deadlines->count() ? convertNumberToNepaliWord($program_add_deadlines->last()->period + 1) : 'पहिलो';
        $data['date'] = $program_add_deadlines->count() ? $program_add_deadlines->last()->period_add_date_nep : $workOrder->program_end_date_nep;

        return response()->json($data);
    }

    public function getPlanOwnEvaluationAmount()
    {
        $amount = running_bill_payment::query()->where('plan_id', request('plan_id'))->get();

        return response()->json(['amount' => ($amount->sum('plan_evaluation_amount') + request('plan_evaluation_amount'))]);
    }

    public function getProgramAntimBhuktani()
    {
        $temp = 0;

        $data['work_order'] = work_order::query()
            ->where('id', request('work_order_id'))
            ->with('Program', 'listRegistrationAttribute')
            ->first();

        $program_advance = program_advance::query()
            ->where('work_order_id', request('work_order_id'))
            ->first();

        $data['program_final_payment_sum'] = program_final_payment::query()
            ->where('work_order_id', request('work_order_id'))
            ->sum('bill_amount');

        $data['program_advance_amount'] = $program_advance == null ? 0 : ($data['program_final_payment_sum'] ? 0 : $data['program_final_payment_sum']);

        $latest_program_final_payment = program_final_payment::query()
            ->where('work_order_id', request('work_order_id'))
            ->latest()
            ->first();

        if (($data['work_order']->cost_participation - $data['program_final_payment_sum']) < 0) {
            $cost_participation = 0;
            $temp = $data['program_final_payment_sum'] - $data['work_order']->cost_participation;
        } else {
            $cost_participation = $data['work_order']->cost_participation - $data['program_final_payment_sum'];
            $temp = 0;
        }

        if (($data['work_order']->cost_sharing - $temp) < 0) {
            $cost_sharing = 0;
            $temp = $temp - $data['work_order']->cost_sharing;
        } else {
            $cost_sharing = $data['work_order']->cost_sharing - $temp;
            $temp = 0;
        }

        if (($data['work_order']->municipality_amount - $temp) < 0) {
            $municipality_amount = 0;
            $temp = $temp - $data['work_order']->municipality_amount;
        } else {
            $municipality_amount = $data['work_order']->municipality_amount - $temp;
        }

        $data['show_form'] = $latest_program_final_payment == null ? false : ($latest_program_final_payment->is_final_payment ? true : false);
        $data['work_order_budget'] = ($data['work_order']->work_order_budget - $data['program_final_payment_sum']);

        $html = "";
        $html .= '<tr>';
        $html .= '<td class="text-center"> रु . ' . Nepali($municipality_amount) . '</td>';
        $html .= '<td class="text-center"> रु . ' . Nepali($cost_sharing) . '</td>';
        $html .= '<td class="text-center"> रु . ' . Nepali($cost_participation) . '</td>';
        $html .= '</tr>';

        $data['html'] = $html;
        return response()->json($data);
    }


    public function getBudgetRowTr(YojanaHelper $helper)
    {
        $fiscal_id = getCurrentFiscalYear(true)->id;

        $budget_sources = BudgetSource::query()->where('fiscal_year_id', $fiscal_id)->get();
        $html = "";
        $html .= '<td class="text-center"><select name="budget_source_id" id="budget_source_id_'.request('row').'"  class="form-control form-control-sm budget_source_id" onchange="changeBudgetSource('.(request('row')).')" required>';
        foreach ($budget_sources as $key => $budget_source) {
            $html .= '<option value="' . $budget_source->id . '" ' . (request('budget_source_id') == $budget_source->id ? "selected" : "") . '>'.$budget_source->name.'</option>';
        }
        $html .= '</select></td>';
        $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm rakam" oninput="changeRakam(0,'.$helper->calculateRemainAmountBudgetSource(request('budget_source_id')).','.(request('row')).')" id="rakam_'.(request('row')).'" name="rakam['.request('budget_source_id').']" value="0" required></td>';
        $html .= '<td class="text-center"><input type="text" class="form-control form-control-sm"  id="baki_'.(request('row')).'" value="'.$helper->calculateRemainAmountBudgetSource(request('budget_source_id')).'" readonly required></td>';
        $html .= '<td class="text-center"><a class="btn btn-sm btn-danger" onclick="removeTr('.request('row').')"><i class="fa-solid fa-xmark"></i></a></td></tr>';
        
        return response()->json($html);
    }

    public function getYojanaReport(Request $request, YojanaHelper $helper)
    {
        $value = explode('-',$request->yojana_amount_type);
          $plan = plan::query()
                ->with('Consumer','kulLagat','type.typeable','otherBibaran','planWards','Advance','runningBillPayment.runningBillPaymentDetails','finalPayment.finalPaymentDeatils.Deduction')
                ->when($request->yojana_amount_type!='', function($q)use($value){
                    if (empty($value[0])) {
                        $q->where('grant_amount','<=',$value[1]);
                    }
                    elseif(empty($value[1]))
                    {
                        $q->where('grant_amount','>',$value[0]);
                    }
                    else{
                        $q->whereBetween('grant_amount',$value);
                    }
                })
                ->when($request->ward_no,function($q) use($request){
                    $q->whereHas('Consumer',function($query)use($request){
                        $query->where('ward_no',$request->ward_no);
                    });
                })
                ->when($request->yojana_running_type,function($q)use($request){
                    if ($request->yojana_running_type==1) {
                        $q->whereHas('Consumer');
                    }
                    elseif ($request->yojana_running_type==2) {
                        $q->whereHas('Advance');
                    }
                    elseif ($request->yojana_running_type==3) {
                        $q->whereHas('runningBillPayment');
                    }
                    elseif($request->yojana_running_type==4)
                    {
                        $q->whereHas('finalPayment');
                    }
                })
            ->paginate(25);
            return response()->json([
                'plan' => $plan,
            ]);
    }
}
