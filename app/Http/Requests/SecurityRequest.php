<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecurityRequest extends FormRequest
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
            'sec_main' => 'required',
            'sec_writer' => 'required'
        ];
    }

    public function messages() {
        return [
            'sec_main.required' => 'Поле Начальник смены является обязательным',
            'sec_writer.required' => 'Поле Инспектор пропускного режима является обязательным'
        ];
    }
}