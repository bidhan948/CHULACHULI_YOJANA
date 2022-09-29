<?php

namespace App\Http\Controllers\MalpotControllers;

use App\Http\Controllers\Controller;
use App\Models\MalpotModel\LandDetail;
use App\Models\MalpotModel\LandOwnerDetail;
use Illuminate\Http\Request;

class MalpotRasidController extends Controller
{
    public function malpot_rasid_create($land_owner_id)
    {
        abort_if($land_owner_id == null, 404);
        $select = "land_owner_details.id as id,
        land_owner_details.land_ward_no as land_ward_no,
        land_owner_details.land_ownership_type as land_ownership_type,
        land_owner_details.pan_number as pan_number,
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
                    land_rates.rate as rate
                ")
                ->join("land_rates",function($join){
                    $join->on("land_rates.land_area_type_id","=","land_details.land_area_type_id")
                        ->on("land_rates.land_category_type_id","=","land_details.land_category_type_id")
                        ->on("land_rates.land_type_id","=","land_details.land_type_id");
                })
            ->where(['land_details.land_owner_id' => $land_owner_id])
            ->where(['land_rates.is_active' => true])
            ->get();
        return view('malpot.rasid.malpot_rasid_create', ['land_details' => $land_details, 'land_owner_data'=>$land_owner_data]);
    }
    public function malpot_rasid_store()
    {
    }
}
