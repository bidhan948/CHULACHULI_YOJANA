<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class FinalPaymentRequest extends FormRequest
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
            'public_exam_date' => 'required',
            'public_group_count' => 'required',
            'plan_end_date' => 'required',
            'type_accept_date' => 'required',
            'anugaman_accept_date' => 'required',
            'assessment_date' => 'required',
            'est_amount' => 'required',
            'hal_mulyankan' => 'required',
            'evaluated_amount' => 'required',
            'final_payable_amount' => 'required',
            'payment_till_now' => 'required',
            'advance_payment' => 'required',
            'ghati_mulyankan_amount' => 'required',
            'total_bhuktani_amount' => 'required',
            'final_contingency_amount' => 'required',
            'deduction_percent.*' => 'required',
            'deduction.*' => 'required',
            'final_total_amount_deducted' => 'required',
            'final_total_paid_amount' => 'required',
        ];
    }
}
