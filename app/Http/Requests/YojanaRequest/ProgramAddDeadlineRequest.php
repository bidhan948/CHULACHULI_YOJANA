<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class ProgramAddDeadlineRequest extends FormRequest
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
            'work_order_id' => 'required',
            'plan_id' => 'required',
            'letter_date_nep' => 'required',
            'institution_date_add_nep' => 'required',
            'period_add_date_nep' => 'required',
            'remark' => 'required'
        ];
    }
}
