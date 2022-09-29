<?php

namespace App\Http\Controllers\MalpotControllers;

use App\Http\Controllers\Controller;
use App\Models\MalpotModel\LandDetail;
use App\Models\MalpotModel\LandOwnerDetail;
use App\Models\MalpotModel\PastPresent;
use Illuminate\Http\Request;

class LandDetailController extends Controller
{
    public function land_detail_list($land_owner_id)
    {
        abort_if($land_owner_id == null, 404);
        $select = "land_owner_details.id as id,
        land_owner_details.land_ward_no as land_ward_no,
        GROUP_CONCAT(land_owner_personal_details.name) as name,
        land_owner_details.sn as sn,
        GROUP_CONCAT(land_owner_personal_details.contact) as contact";
        $land_owner_data = LandOwnerDetail::selectRaw($select)
            ->join('land_owner_personal_details', 'land_owner_personal_details.land_owner_detail_id', '=', 'land_owner_details.id')
            ->where(['land_owner_details.status' => 1])
            ->where(['land_owner_details.id' => $land_owner_id])
            ->groupBy('land_owner_details.id')
            ->first();
        abort_if($land_owner_data == null, 404);

        $land_details = LandDetail::selectRaw("
                    land_details.id as id,
                    land_details.kitta_no as kitta_no,
                    land_details.naksa_no as naksa_no,
                    land_details.old_vdc_mp as old_vdc_mp,
                    land_details.old_ward as old_ward,
                    land_details.new_vdc_mp as new_vdc_mp,
                    land_details.new_ward as new_ward,
                    land_details.bigha_ropani as bigha_ropani,
                    land_details.kattha_aana as kattha_aana,
                    land_details.dhur_paisa as dhur_paisa,
                    land_details.kanwa_dam as kanwa_dam,
                    land_details.meter_sq as meter_sq,
                    land_details.ft_sq as ft_sq,
                    lat.name as land_area_type_name,
                    lat.id as land_area_type_id,
                    lct.name as land_category_type_name,
                    lct.id as land_category_type_id,
                    lt.name as land_type_name,
                    lt.id as land_type_id
                ")
            ->leftJoin(env('DB_DATABASE_SHARED') . '.setup_setting_values as lat', 'land_details.land_area_type_id', '=', 'lat.id')
            ->leftJoin(env('DB_DATABASE_SHARED') . '.setup_setting_values as lct', 'land_details.land_category_type_id', '=', 'lct.id')
            ->leftJoin(env('DB_DATABASE_SHARED') . '.setup_setting_values as lt', 'land_details.land_type_id', '=', 'lt.id')
            ->where(['land_owner_id' => $land_owner_id])
            ->get();
        return view('malpot.land_detail.land_detail_list', ["land_owner_id" => $land_owner_id, 'land_owner_data' => $land_owner_data, 'land_details' => $land_details]);
    }
    public function land_detail_add($land_owner_id)
    {
        abort_if($land_owner_id == null, 404);
        $select = "land_owner_details.id as id,
        land_owner_details.land_ward_no as land_ward_no,
        GROUP_CONCAT(land_owner_personal_details.name) as name,
        land_owner_details.sn as sn,
        GROUP_CONCAT(land_owner_personal_details.contact) as contact";
        $land_owner_data = LandOwnerDetail::selectRaw($select)
            ->join('land_owner_personal_details', 'land_owner_personal_details.land_owner_detail_id', '=', 'land_owner_details.id')
            ->where(['land_owner_details.status' => 1])
            ->where(['land_owner_details.id' => $land_owner_id])
            ->groupBy('land_owner_details.id')
            ->first();
        abort_if($land_owner_data == null, 404);

        $sabik_gapa = PastPresent::selectRaw('DISTINCT(old_vdc_mp) as old_vdc_mp')->get();
        $sabik_ward = PastPresent::selectRaw('DISTINCT(old_ward)')->get();
        return view('malpot.land_detail.land_detail_add', [
            "land_owner_id" => $land_owner_id,
            'land_owner_data' => $land_owner_data,
            'sabik_gapa' => $sabik_gapa,
            'sabik_ward' => $sabik_ward
        ]);
    }
    public function land_detail_store(Request $request)
    {
        $validate = $request->validate([
            'old_vdc_mp' => 'required',
            'old_ward' => 'required',
            'new_vdc_mp' => 'required',
            'new_ward' => 'required',
            'land_area_type_id' => 'required',
            'land_category_type_id' => 'required',
            'land_type_id' => 'required',
            'kitta_no' => 'required',
            'naksa_no' => 'required',
            'bigha_ropani' => 'required',
            'kattha_aana' => 'required',
            'dhur_paisa' => 'required',
            'kanwa_dam' => 'required',
            'meter_sq' => 'required',
            'ft_sq' => 'required',
            'land_owner_id' => 'required',
        ], [
            'old_vdc_mp.required' => 'साबिक गा.पा/न.पा आवश्यक छ |',
            'old_ward.required' => 'साबिक वडा नं आवश्यक छ |',
            'new_vdc_mp.required' => 'हाल गा.पा/न.पा आवश्यक छ |',
            'new_ward.required' => 'हाल वडा नं आवश्यक छ |',
            'land_area_type_id.required' => 'जग्गाको क्षेत्रगत किसिम आवश्यक छ |',
            'land_category_type_id.required' => 'जग्गाको वर्गीकरण आवश्यक छ |',
            'land_type_id.required' => 'जग्गाको श्रेणी आवश्यक छ |',
            'kitta_no.required' => 'कित्ता नं आवश्यक छ |',
            'naksa_no.required' => 'नक्सा नं आवश्यक छ |',
            'bigha_ropani.required' => config('constant.BIGGA') .' आवश्यक छ |',
            'kattha_aana.required' => config('constant.KATTHA') .' आवश्यक छ |',
            'dhur_paisa.required' => config('constant.DHUR') .' आवश्यक छ |',
            'kanwa_dam.required' => config('constant.KANUA') .' आवश्यक छ |',
            'meter_sq.required' => 'क्षेत्रफल वर्ग मिटर आवश्यक छ |',
            'ft_sq.required' => 'क्षेत्रफल वर्ग फिट आवश्यक छ |',
        ]);

        $id = $request->id;
        if (empty($id)) {
            $past_present = LandDetail::create($validate);
            $id = $past_present->id;
        } else {
            $past_present = LandDetail::where(['id' => $id, 'is_active' => true])->first();
            $past_present->update($validate);
        }
        return redirect()->route('land_detail_list', ['land_owner_id' => $request->land_owner_id]);
    }
}
