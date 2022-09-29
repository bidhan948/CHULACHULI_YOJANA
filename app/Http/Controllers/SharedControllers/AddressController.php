<?php

namespace App\Http\Controllers\SharedControllers;

use App\Http\Controllers\Controller;
use App\Models\SharedModel\District;
use App\Models\SharedModel\Municipality;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function get_districts(Request $request)
    {
        $id = $request->id;
        $data = District::where('pid' , $id)->get();
        return response()->json($data);
    }

    public function get_municipalities(Request $request)
    {
        $id = $request->id;
        $data = Municipality::query()->
                    selectRaw("id,did,CONCAT(name, ' ', type) as name, CONCAT(nep_name, ' ', nep_type) as nep_name, total_wards")
                    ->where('did' , $id)->get();
        return response()->json($data);
    }
}
