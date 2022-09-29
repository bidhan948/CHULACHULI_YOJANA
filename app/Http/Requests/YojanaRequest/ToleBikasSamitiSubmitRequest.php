<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class ToleBikasSamitiSubmitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'ward_no' => 'required',
            'date_nep' => 'required',
            'former_address' => 'required',
            'former_ward_no' => 'required',
            'position' => 'required',
            'exp_date_nep'=> 'required',
            'detail_name.*' => 'required',
            'gender.*' => 'required',
            'cit_no.*' => 'required',
            'issue_district.*' => 'required',
            'contact_no.*' => 'required',
        ];
    }
}
