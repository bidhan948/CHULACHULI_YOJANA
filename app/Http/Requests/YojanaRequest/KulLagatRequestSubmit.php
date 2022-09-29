<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class KulLagatRequestSubmit extends FormRequest
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
            'napa_amount' => 'required',
            'other_office_con' => 'required',
            'other_office_agreement' => 'required',
            'customer_agreement' => 'required',
            'work_order_budget' => 'required',
            'consumer_budget' => 'required',
            'total_investment' => 'required',
            'quantity' => 'required',
            'unit_id' => 'required'
        ];
    }
}
