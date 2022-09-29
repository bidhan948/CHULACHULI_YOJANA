<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class WorkOrderRequest extends FormRequest
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
            'name' => 'required',
            'decision_date_nep' => 'required',
            'municipality_amount' => 'required',
            'cost_participation' => 'present',
            'cost_sharing' => 'required',
            'cost_sharing_name' => 'required',
            'date_nep' => 'required',
            'program_start_date_nep' => 'required',
            'program_end_date_nep' => 'required',
            'work_order_budget' => 'required',
            'list_registration_attribute_id' => 'required',
            'house_family_count' => 'present',
            'female' => 'present',
            'male' => 'present',
            'venue' => 'required'
        ];
    }
}
