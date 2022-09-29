<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class ConsumerRequest extends FormRequest
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
            'name'=>'required',
            'plan_id' => 'required',
            'ward_no' => 'required',
            'post_id.*' => 'required',
            'fullname.*' => 'required',
            'ward_no_consumer.*' => 'required',
            'consumer_gender.*' => 'required',
            'cit_no.*' => 'required',
            'issue_district.*' => 'required',
            'contact_no.*' => 'required',
        ];
    }
}
