<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class PeskiBhuktaniRequest extends FormRequest
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
            'peski_amount' => 'required',
            'remark'=> 'required',
            'peski_given_date_nep' => 'required',
            'advance_paid_date_nep' => 'required',
            'father_name' => 'sometimes',
            'g_father_name' => 'sometimes',
            'plan_id' => 'required'
        ];
    }
}
