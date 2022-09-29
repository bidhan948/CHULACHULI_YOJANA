<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class ListRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'list_registration_id' => 'required',
            'name' => 'required',
            'address' => 'prohibited_if:list_registration_id,' . config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI'),
            'contact_no' => 'prohibited_if:list_registration_id,' . config('YOJANA.LIST_REGISTRATION.UPABHOKTA_SAMITI'),
            'post_id.*' => 'present',
            'detail_name.*' => 'present',
            'detail_name.*' => 'present',
            'ward_no.*' => 'present',
            'gender.*' => 'present',
            'cit_no.*' => 'present',
            'issue_district.*' => 'present',
            'detail_contact_no.*' => 'present',
        ];
    }
}
