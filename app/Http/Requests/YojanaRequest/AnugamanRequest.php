<?php

namespace App\Http\Requests\YojanaRequest;

use Illuminate\Foundation\Http\FormRequest;

class AnugamanRequest extends FormRequest
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
            'anugaman_samiti_type_id' => 'required',
            'name' => 'required',
            'ward_no' => 'required_if:anugaman_samiti_type_id,==,0',
            'post_id.*' => 'required',
            'samiti_name.*' => 'required'
        ];
    }
}
