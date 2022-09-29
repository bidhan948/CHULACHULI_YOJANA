<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class ProgramAdvanceRequest extends FormRequest
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
            'program_id' => 'required',
            'amount' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'g_father_name' => 'required',
            'advance_given_date_nep' => 'required',
            'advance_paid_date_nep' => 'required',
            'remark' => 'required'
        ];
    }
}
