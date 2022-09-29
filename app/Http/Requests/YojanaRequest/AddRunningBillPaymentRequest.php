<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class AddRunningBillPaymentRequest extends FormRequest
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
            "plan_id" => "required",
            "bill_date_nep" => "required",
            "est_amount" => "required",
            "plan_evaluation_amount" => "required",
            "plan_own_evaluation_amount" => "required",
            "payable_amount" => "required",
            "peski_amount" => "required",
            "contingency_amount" => "required",
            "deduction_percent.*" => "required",
            "deduction.*" => "required",
            "total_katti_amount" => "required",
            "total_paid_amount" => "required",
            "bill_payable_date" => "required"
        ];
    }
}
