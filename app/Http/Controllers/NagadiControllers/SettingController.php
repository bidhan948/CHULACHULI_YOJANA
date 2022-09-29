<?php

namespace App\Http\Controllers\NagadiControllers;

use App\Http\Controllers\Controller;
use App\Models\NagadiModel\Category;
use App\Models\SharedModel\FiscalYear;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        session(['active_app' => 'nagadi']);

        $data = Category::where('pid', null)
            ->with('categories')
            ->with('fiscal_year', function ($q) {
                $q->where('is_current', true);
            })->get();
        // dd($data);
        return view('nagadi.setting.main-sirsak-list', ['data' => $data]);
        // return redirect()->back
    }

    public function store_main_sirsak(Request $request)
    {
        session(['active_app' => 'nagadi']);
        $current_fiscal_year = FiscalYear::where('is_current', true)->first();
        if (empty($current_fiscal_year)) {
            die();
        }

        $validate = $request->validate(['name' => 'required', 'topic_number' => 'required']);

        $data_to_save = $validate + [
            'fiscal_year_id' => $current_fiscal_year->id,
            'has_child' => true
        ];
        $id = $request->id;
        if (empty($id)) {
            $db_response =  Category::create($data_to_save);
            $id = $db_response->id;
        } else {
            $cat = Category::where('id', $request->id)->first();
            $cat->update($data_to_save);
        }
        return response()->json(['id' => $id]);
    }


    public function store_upa_sirsak(Request $request)
    {
        session(['active_app' => 'nagadi']);

        $validate = $request->validate(['name' => 'required', 'pid' => 'required']);

        $id = $request->id;
        if (empty($id)) {
            $db_response =  Category::create($validate);
            $id = $db_response->id;
        } else {
            $cat = Category::where('id', $request->id)->first();
            $cat->update($validate);
        }
        return response()->json(['id' => $id]);
    }

    public function dar_create()
    {
        $main_sirshak = Category::where('pid', null)
            ->with('fiscal_year', function ($q) {
                $q->where('is_current', true);
            })->get();
        return view('nagadi.setting.dar-create', ['main_sirshak'=> $main_sirshak]);
    }


    public function dar_store(Request $request)
    {
        $request->validate(['main_sirsak.*'=>'required', 'upa_sirsak.*'=>'required']);

        foreach ($request->main_sirsak as $key => $item) {
            if(empty($request->sirsak[$key])) {
                $data = Category::where('id', $request->upa_sirsak[$key])->first();
                if($data->has_child) {
                    return redirect()->back()->withErrors(['sirsak', 'शिर्षक आबस्यक छ|']);
                } else {
                    $data->update(['rate' => $request->rate[$key], 'rate_type' =>  $request->rate_type[$key]]);
                }
            } else {
                $data = [
                    'pid' => $request->upa_sirsak[$key],
                    'name' => $request->sirsak[$key],
                    'rate' => $request->rate[$key],
                    'has_child' => false,
                    'rate_type' =>  $request->rate_type[$key]
                ];
                Category::where('id', $request->upa_sirsak[$key])->update(['has_child' => true]);
                Category::create($data);
            }
        }

        return redirect()->back();
    }


    public function get_categories_by_pid(Request $request)
    {
        $pid = $request->pid;
        $data = Category::where('pid', $pid)->get();
        return response()->json($data);
    }
}
