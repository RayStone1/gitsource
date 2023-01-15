<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SourceRequest extends FormRequest
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
            'province_id'=>'required|integer',
            'l1_id'=>'required|integer',
            'l2_id'=>'nullable',
            'name_id'=>'required|integer',
            'topic_name'=>'required|string',
            'header_name'=>'required|string',
        ];
    }
    public function attributes()
    {
        return [
            'province_id'=>'Субъект РФ',
            'l1_id'=>'Муниципальные образования 1ого уровня',
            'mun_two'=>'Муниципальные образования 2ого уровня',
            'name_id'=>'Орган власти',
        ];
    }
    public function messages()
    {
        return [
            'unique' => 'Такой субъект уже существует',
            'required'=>':attribute обязательное поле'
        ];
    }
}
