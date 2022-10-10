<?php

namespace App\Http\Controllers\YojanaControllers\setting;

use App\Helpers\YojanaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\YojanaRequest\ListRegistrationRequest;
use App\Models\SharedModel\Setting;
use App\Models\YojanaModel\setting\list_registration;
use App\Models\YojanaModel\setting\list_registration_attribute;
use App\Models\YojanaModel\setting\list_registration_attribute_detail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListRegistrationController extends Controller
{
    public function index(): View
    {
        return view('yojana.setting.list_registration', [
            'list_registrations' => list_registration::query()->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attribute = $request->validate(['name' => 'required|unique:list_registrations']);
        list_registration::create($attribute);
        toast('सुची दर्ता हाल्न सफल भयो', 'success');
        return redirect()->back();
    }

    public function bibaranIndex(YojanaHelper $helper): View
    {
        return view('yojana.setting.list_registration_bibaran', [
            'list_registrations' => list_registration::query()->get(),
            'posts' => $helper->getPostViasSession(config('TYPE.SANSTHA_SAMITI'))
        ]);
    }

    public function bibaranStore(ListRegistrationRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $list_registration_attribute =  list_registration_attribute::create($request->except(
                'post_id',
                'detail_name',
                'gender',
                'cit_no',
                'issue_district',
                'detail_contact_no'
            ) + ['list_registration_id' => $request->list_registration_id]);

            if ($request->has('post_id')) {
                foreach ($request->post_id as $key => $post_id) {
                    list_registration_attribute_detail::create([
                        'list_registration_attribute_id' => $list_registration_attribute->id,
                        'post_id' => $post_id,
                        'name' => $request->detail_name[$key],
                        'gender' => $request->gender[$key],
                        'cit_no' => $request->cit_no[$key],
                        'issue_district' => $request->issue_district[$key],
                        'contact_no' => $request->detail_contact_no[$key],
                        'ward_no' => $request->detail_ward_no[$key]
                    ]);
                }
            }
        });

        toast('सुची दर्ता हाल्न सफल भयो', 'success');
        return redirect()->back();
    }

    public function bibaranShow(): View
    {
        return view('yojana.setting.show_list_registration', [
            'list_registrations' => list_registration::query()->get()
        ]);
    }

    public function fullBibaranShow(list_registration_attribute $list_registration_attribute): View
    {
        return view('yojana.setting.bibaran_list_registration', [
            'list_registration_attribute' => $list_registration_attribute->load('listRegistrationAttributeDetails', 'listRegistration')
        ]);
    }

    public function bibaranEdit(list_registration_attribute $list_registration_attribute, YojanaHelper $helper): View
    {
        return view('yojana.setting.list_registration_bibaran_edit', [
            'list_registration_attribute' => $list_registration_attribute->load('listRegistrationAttributeDetails', 'listRegistration'),
            'posts' => $helper->getPostViasSession(config('TYPE.SANSTHA_SAMITI'))
        ]);
    }

    public function bibaranUpdate(ListRegistrationRequest $request, list_registration_attribute $list_registration_attribute): RedirectResponse
    {
        // dd($request->validated());
        DB::transaction(function () use ($list_registration_attribute, $request) {
            $list_registration_attribute->update($request->except(
                'post_id',
                'detail_name',
                'gender',
                'cit_no',
                'issue_district',
                'detail_contact_no',
                'list_registration_id'
            ));

            list_registration_attribute_detail::query()
                ->where('list_registration_attribute_id', $list_registration_attribute->id)
                ->delete();

            if ($request->has('post_id')) {
                foreach ($request->post_id as $key => $post_id) {
                    list_registration_attribute_detail::create([
                        'list_registration_attribute_id' => $list_registration_attribute->id,
                        'post_id' => $post_id,
                        'name' => $request->detail_name[$key],
                        'gender' => $request->gender[$key],
                        'cit_no' => $request->cit_no[$key],
                        'issue_district' => $request->issue_district[$key],
                        'contact_no' => $request->detail_contact_no[$key],
                        'ward_no' => $request->detail_ward_no[$key]
                    ]);
                }
            }
        });

        toast('सुची दर्ता सच्याउन सफल भयो', 'success');
        return redirect()->back();
    }
}