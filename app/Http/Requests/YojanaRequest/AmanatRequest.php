<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class AmanatRequest extends FormRequest
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
            'name' => 'required',
            'plan_id' => 'required|exists:plans,id',
            'address' => 'required',
            'fullname' => 'present',
            'ward_no' =>'present',
            'cit_no' =>'present',
            'issue_district' =>'present',
            'mobile_no' =>'present',
        ];
    }
}
