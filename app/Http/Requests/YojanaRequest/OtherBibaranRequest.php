<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class OtherBibaranRequest extends FormRequest
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
            'plan_id' => 'required',
            'formation_start_date' => 'sometimes',
            'start_date' => 'required',
            'end_date' => 'sometimes',
            'staff_id' => 'required',
            'agreement_date_nep' => 'required',
            'post.*' => 'required',
            'house_family_count' => 'required',
            'female' => 'required',
            'male' => 'required',
            'committee_count' => 'sometimes'
        ];
    }
}
