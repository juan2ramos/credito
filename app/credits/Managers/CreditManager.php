<?php namespace credits\Managers;

class CreditManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'identificacion_card'   => 'required',
            'name'                    => 'required',
            'second_name'      => 'required',
            'last_name'      => 'required',
            'second_last_name'               => 'required',
            'birth_city'              => 'required',
            'city_residency'             => 'required',
            'date_expedition'     => 'required',
            'instead_expedition'               => 'required',
            'date_birth'        => 'required',
            'mobile_phone'            => 'required',
            'phone'         => 'required',
            'address'         => 'required',
            'office_address'         => 'required',
            'monthly_income'         => 'required',
            'monthly_expenses'         => 'required',
            'name_reference'         => 'required',
            'phone_reference'         => 'required',
            'name_reference2'         => 'required',
            'phone_reference2'         => 'required',
            'files'         => 'required',

        ];
        return  $rules;
    }
}