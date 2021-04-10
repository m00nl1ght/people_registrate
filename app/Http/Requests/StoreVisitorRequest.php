<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitorRequest extends FormRequest
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
    public function rules() {
        return [
            'visitor_surname' => 'required|alpha',
            'visitor_name' => 'required',
            'visitor_patronymic' => 'required',
            // 'visitor_phone' => 'required',
            'visitor_firm' => 'required',
            'visitor_category' => 'required',
            'visitor_security' => 'required',
            'employee_surname' => 'required',
            'employee_name' => 'required',
            'employee_patronymic' => 'required',
        ];
    }

    public function messages() {
        return [
            'visitor_surname.required' => 'Введите фамилию посетителя',
            'visitor_surname.alpha' => 'Некорректно введена фамилия',
            'visitor_name.required' => 'Введите имя посетителя',
            'visitor_patronymic.required' => 'Введите отчество посетителя',
            // 'visitor_phone' => 'required',
            'visitor_firm.required' => 'Введите компанию посетителя',
            'visitor_security.required' => 'Введите фамилию сотрудника охраны',
            'employee_surname.required' => 'Введите имя сотрудника КЛААС',
            'employee_name.required' => 'Введите фамилию сотрудника КЛААС',
            'employee_patronymic.required' => 'Введите отчество сотрудника КЛААС',
        ];
    }
}