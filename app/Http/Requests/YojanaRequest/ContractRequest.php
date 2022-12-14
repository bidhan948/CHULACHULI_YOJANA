<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
            'has_deadline' => 'required',
            'thekka_amount' => 'required',
            'prakashit_date' => 'required',
            'total_thekka_amount' => 'required',
            'dakhila_date' => 'required',
            'remarks' => 'required'
        ];
    }
}
