<?php namespace credits\Managers;

class UserManager extends BaseManager
{

    public function getRules()
    {
        $rules=[

            'name'                  => 'required',
            'second_name'           => 'required',
            'last_name'             => 'required',
            'second_last_name'      => 'required',
            'address'               => 'required',
            'residency_city'        => 'required',
            'birth_city'            => 'required',
            'mobile_phone'          => 'required|numeric',
            'phone'                 => 'required|numeric',
            'document_type'         => 'required|numeric',
            'identification_card'   => 'required|numeric|unique:users',
            'date_birth'            => 'required',


        ];
        return  $rules;
    }



}