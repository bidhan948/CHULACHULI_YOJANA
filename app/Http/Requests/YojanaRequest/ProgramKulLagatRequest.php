<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class ProgramKulLagatRequest extends FormRequest
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
            'bibaran.*' => 'required',
            'unit_id.*' => 'required',
            'unit_price.*' => 'required',
            'quantity.*' => 'required',
            'total.*' => 'required',
            'remarks.*' => 'required',
            'work_order_id' => 'required',
        ];
    }
}
