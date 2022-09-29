<?php

namespace App\Http\Controllers\MalpotControllers;

use App\Http\Controllers\Controller;
use App\Models\MalpotModel\LandRate;
use App\Models\MalpotModel\PastPresent;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function haal_sabik_list()
    {
        $data = PastPresent::where(['is_active' => true])->get();
        return view('malpot.setting.haal_sabik_list', ['data' => $data]);
    }

    public function get_haal_from_sabik(Request $request)
    {
        $old_vdc_mp = $request->old_vdc_mp;
        $old_ward = $request->old_ward;
        $data = PastPresent::where(['is_active' => true, 'old_vdc_mp' => $old_vdc_mp, 'old_ward' => $old_ward])->first();
        return response()->json($data);
    }

    public function haal_sabik_store(Request $request)
    {

        $validate = $request->validate([
            'old_ward' => 'required',
            'old_vdc_mp' => 'required',
            'new_ward' => 'required',
            'new_vdc_mp' => 'required'
        ]);

        $id = $request->id;
        if (empty($id)) {
            $past_present = PastPresent::create($validate);
            $id = $past_present->id;
        } else {
            $past_present = PastPresent::where(['id' => $id, 'is_active' => true])->first();
            $past_present->update($validate);
        }
        return $id;
    }


    public function land_rate_list()
    {
        $current_fiscal_year = getCurrentFiscalYear(true)->id;
        $data = LandRate::selectRaw("
                                    land_rates.id as id,
                                    land_rates.rate as rate,
                                    lat.name as land_area_type_name,
                                    lat.id as land_area_type_id,
                                    lct.name as land_category_type_name,
                                    lct.id as land_category_type_id,
                                    lt.name as land_type_name,
                                    lt.id as land_type_id
                                   ")
            ->leftJoin(env('DB_DATABASE_SHARED') . '.setup_setting_values as lat', 'land_rates.land_area_type_id', '=', 'lat.id')
            ->leftJoin(env('DB_DATABASE_SHARED') . '.setup_setting_values as lct', 'land_rates.land_category_type_id', '=', 'lct.id')
            ->leftJoin(env('DB_DATABASE_SHARED') . '.setup_setting_values as lt', 'land_rates.land_type_id', '=', 'lt.id')
            ->where(['is_active' => true])->get();

        $land_area_types = get_setting(config('SLUG.setup_land_area_types'));
        $land_category_types = get_setting(config('SLUG.setup_land_category_types'));
        $land_types = get_setting(config('SLUG.setup_land_types'));
        return view('malpot.setting.land_rate_list', [
            'data' => $data,
            'land_area_types' => $land_area_types,
            'land_category_types' => $land_category_types,
            'land_types' => $land_types
        ]);
    }

    public function land_rate_store(Request $request)
    {
        $validate = $request->validate([
            'land_area_type_id' => 'required',
            'land_category_type_id' => 'required',
            'land_type_id' => 'required',
            'rate' => 'required'
        ]);
        $current_fiscal_year = getCurrentFiscalYear(true)->id;
        $data = $validate + ['fiscal_year_id' => $current_fiscal_year];
        $id = $request->id;
        if (empty($id)) {
            $past_present = LandRate::create($data);
            $id = $past_present->id;
        } else {
            $past_present = LandRate::where(['id' => $id, 'is_active' => true])->first();
            $past_present->update($data);
        }
        return $id;
    }
}
