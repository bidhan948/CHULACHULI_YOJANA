<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class NewPlanFormRequest extends FormRequest
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
            "rakam.*" => 'required',
            "budget_source_id" => 'required',
            "detail" => "present",
            "type_id" => "sometimes",
            "topic_id" => "required",
            "topic_area_type_id" => "required",
            "type_of_allocation_id" => "required",
            "ward_no.*" => "required",
            "grant_amount" => "required",
            "first_installment" => "present",
            "second_installment" => "present",
            "third_installment" => "present",
            "name"=>'required'
        ];
    }
}
