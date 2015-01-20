<?php namespace credits\Managers;

class UserManager extends BaseManager
{

    public function getRules()
    {
        $rules=[

            'name'     => 'required',
            'second_name'     => 'required',
            'last_name'         => 'required',
            'second_last_name'         => 'required',
            'address'         => 'required',
            'residency_city'         => 'required',
            'birth_city'         => 'required',
            'mobile_phone'         => 'required',
            'phone'         => 'required',
            'document_type'         => 'required',
            'identification_card'         => 'required',
            'date_birth'         => 'required'

        ];
        return  $rules;
    }

    public function saveUser()
    {
       //$user=$this->entity->find(1);

        //$this->entity->CreditRequest()->save();
    }

}