<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class ThekkaKabolRequest extends FormRequest
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
            'contractor_name',
            'has_vat',
            'total_kabol_amount',
            'total_amount',
            'bank_guarantee_amount',
            'bail_account_amount',
            'plan_id'
        ];
    }
}
