<?php

namespace App\Http\Controllers\MalpotControllers;

use App\Http\Controllers\Controller;
use App\Models\MalpotModel\LandOwnerDetail;
use App\Models\MalpotModel\LandOwnerPersonelDetail;
use App\Models\SharedModel\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function land_profile_list()
    {
        return view('malpot.profile.land_owner_profile');
    }
    public function land_profile_add()
    {
        $provinces = Province::get();
        return view('malpot.profile.land_owner_profile_add', [
            'provinces' => $provinces
        ]);
    }

    private function lettersToNumber($letters)
    {
        $alphabet = range('A', 'Z');
        $number = 0;

        foreach (str_split(strrev($letters)) as $key => $char) {
            $number = $number + (array_search($char, $alphabet) + 1) * pow(count($alphabet), $key);
        }
        return $number;
    }
    private function formatNumber($number, $no_of_digit)
    {
        $length = strlen((string)$number);
        for ($i = $length; $i < $no_of_digit; $i++) {
            $number = '0' . $number;
        }
        return $number;
    }
    public function land_profile_store(Request $request)
    {
        $validate = $request->validate([
            'land_ward_no' => 'required',
            'land_ownership_type' => 'required',
            'permanent_province' => 'required',
            'permanent_district' => 'required',
            'permanent_municipality' => 'required',
            'permanent_ward' => 'required',
            'single_ownership_type' => 'required_if:land_ownership_type,"single"',
            'organization_type' => 'required_if:land_ownership_type,"organization"',
            'dakhila_date_nep' => 'required',
            'dakhila_date_eng' => 'required',
            'dakhila_province' => 'required',
            'dakhila_district' => 'required',
            'dakhila_municipality' => 'required',
            'dakhila_ward' => 'required',
            'dakhila_relation' => 'required',
            'dakhila_name' => 'required',
            'pan_number' => 'required_if:land_ownership_type,"organization"',
            'contact_name' => 'required_if:land_ownership_type,"organization"',
            'contact_name_english' => 'required_if:land_ownership_type,"organization"',
            'contact_number' => 'required_if:land_ownership_type,"organization"'
        ]);
        $request->validate([
            'name.*' => 'required',
            'name_english.*' => 'required',
            'gender.*' => 'required_if:land_ownership_type,"single"',
            'father_name.*' => 'required_if:land_ownership_type,"single"',
            'grandfather_name.*' => 'required_if:land_ownership_type,"single"',
            'nationality_id.*' => 'required_if:land_ownership_type,"single"',
            'job_id.*' => 'required_if:land_ownership_type,"single"'
        ]);

        $data = $validate + [
            'temprorary_province' => $request->temprorary_province,
            'temprorary_district' => $request->temprorary_district,
            'temprorary_municipality' => $request->temprorary_municipality,
            'temprorary_ward' => $request->temprorary_ward,
            'temprorary_tole' => $request->temprorary_tole,
            'permanent_tole' => $request->permanent_tole,
            'contact_email' => $request->contact_email,
            'house_number' => $request->house_number
        ];

        if ($data['land_ownership_type'] == 'organization') {
            $data['single_ownership_type'] = null;
            $arr[0]['name'] = $request->name[0];
            $arr[0]['name_english'] = $request->name_english[0];
            $arr[0]['gender'] = null;
            $arr[0]['father_name'] = null;
            $arr[0]['grandfather_name'] = null;
            $arr[0]['nationality_id'] = null;
            $arr[0]['job_id'] = null;
            $arr[0]['email'] = $request->email[0];
            $arr[0]['contact'] = $request->contact[0];
        } else {
            $data['organization_type'] = null;
            if ($data['single_ownership_type'] == 1) {
                $arr[0]['name'] = $request->name[0];
                $arr[0]['name_english'] = $request->name_english[0];
                $arr[0]['gender'] = $request->gender[0];
                $arr[0]['father_name'] = $request->father_name[0];
                $arr[0]['grandfather_name'] = $request->grandfather_name[0];
                $arr[0]['nationality_id'] = $request->nationality_id[0];
                $arr[0]['job_id'] = $request->job_id[0];
                $arr[0]['email'] = $request->email[0];
                $arr[0]['contact'] = $request->contact[0];
            } else {
                foreach ($request->name as $key => $value) {
                    $arr[$key]['name'] = $value;
                    $arr[$key]['name_english'] = $request->name_english[$key];
                    $arr[$key]['gender'] = $request->gender[$key];
                    $arr[$key]['father_name'] = $request->father_name[$key];
                    $arr[$key]['grandfather_name'] = $request->grandfather_name[$key];
                    $arr[$key]['nationality_id'] = $request->nationality_id[$key];
                    $arr[$key]['job_id'] = $request->job_id[$key];
                    $arr[$key]['email'] = $request->email[$key];
                    $arr[$key]['contact'] = $request->contact[$key];
                }
            }
        }
        $eng_name = trim($arr[0]['name_english'], " ");
        $first_letter_number = $this->lettersToNumber(substr($eng_name, 0, 1));
        $max_number = LandOwnerDetail::where(['first_letter_number' => $first_letter_number, 'land_ward_no' => $data['land_ward_no']])->max('number');

        if (empty($max_number)) $max_number = 0;

        $sn = $this->formatNumber($first_letter_number, 2) . '-' . $this->formatNumber($data['land_ward_no'], 2) . '-' . $this->formatNumber($max_number + 1, 5);
        $data['sn'] = $sn;
        $data['number'] = $max_number + 1;
        $data['first_letter_number'] = $first_letter_number;
        DB::transaction(function () use ($data, $arr) {
            $land_owner_detail = LandOwnerDetail::create($data);
            foreach ($arr as $key => $item) {
                $item['land_owner_detail_id'] = $land_owner_detail->id;
                LandOwnerPersonelDetail::create($item);
            }
        });
        // return redirect()->name('land_profile_list');
    }


    public function get_land_profile_list(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";

        $totalDataRecord = LandOwnerDetail::where('status', '=', 1)->count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->length;
        $start_val = $request->start;


        $select = "land_owner_details.id as id,
                   land_owner_details.land_ward_no as land_ward_no,
                   GROUP_CONCAT(land_owner_personal_details.name) as name,
                   land_owner_details.sn as sn,
                   GROUP_CONCAT(land_owner_personal_details.contact) as contact";

        if (empty($request->input('search.value'))) {
            $land_owner_data = LandOwnerDetail::selectRaw($select)
                ->join('land_owner_personal_details', 'land_owner_personal_details.land_owner_detail_id', '=', 'land_owner_details.id')
                ->where(['land_owner_details.status' => 1])
                ->offset($start_val)
                ->limit($limit_val)
                ->groupBy('land_owner_details.id')
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $land_owner_data =  LandOwnerDetail::selectRaw($select)
                ->join('land_owner_personal_details', 'land_owner_personal_details.land_owner_detail_id', '=', 'land_owner_details.id')
                ->where(['land_owner_details.status' => 1])
                ->where('land_owner_details.id', 'LIKE', "%{$search_text}%")
                ->orWhere('land_owner_personal_details.name', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->groupBy('land_owner_details.id')
                ->get();

            $totalFilteredRecord = LandOwnerDetail::selectRaw($select)
                ->where(['land_owner_details.status' => 1])
                ->where('land_owner_details.id', 'LIKE', "%{$search_text}%")
                ->orWhere('land_owner_personal_details.name', 'LIKE', "%{$search_text}%")
                ->count();
        }
        $data_val = array();
        if (!empty($land_owner_data)) {
            $i = $start_val + 1;
            foreach ($land_owner_data as $land_owner_val) {
                $postnestedData['start'] = Nepali($i);
                $postnestedData['land_ward_no'] = Nepali($land_owner_val->land_ward_no);
                $postnestedData['id'] = Nepali($land_owner_val->id);
                $postnestedData['name'] = $land_owner_val->name;
                $postnestedData['sn'] = Nepali($land_owner_val->sn);
                $postnestedData['contact'] = Nepali($land_owner_val->contact);
                $postnestedData['options'] = "<a class=\"btn-info btn-flat btn btn-sm\" href=\"".route('malpot_rasid_create',['land_owner_id'=> $land_owner_val->id])."\">यो आर्थिक वर्षको रशिद काट्नुहोस्</a>&nbsp;";
                $postnestedData['options'] .= "<a class=\"btn-info btn-flat btn btn-sm\" href=\"".route('land_detail_list',['land_owner_id'=> $land_owner_val->id])."\">जग्गाको विवरण</a>&nbsp;";
                $postnestedData['options'] .= "<a class=\"btn-info btn-flat btn btn-sm\" href=\"malpot/\">संरचनाको विवरण भर्नुहोस्</a>&nbsp;";
                $postnestedData['options'] .= "<a class=\"btn-info btn-flat btn btn-sm\" href=\"malpot/\">रशिदहरुको विवरण</a>";
                $data_val[] = $postnestedData;
                $i++;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );
        return response()->json($get_json_data);
    }


}
