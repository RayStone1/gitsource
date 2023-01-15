<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MunTwoRequest extends FormRequest
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
            'name'=>'required|unique:fs_mun_l2',
            'mind'=>'required'
        ];
    }
    public function attributes()
    {
        return [
            'name'=>'Субъект РФ',
            'minD'=>'MinD',
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
