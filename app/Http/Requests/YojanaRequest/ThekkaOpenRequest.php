<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class ThekkaOpenRequest extends FormRequest
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
            'name' => 'required',
            'bank_name' => 'required',
            'bank_guarantee_amount' => 'required',
            'bank_date' => 'required',
            'bail_amount' => 'required',
            'remark' => 'required'
        ];
    }
}
