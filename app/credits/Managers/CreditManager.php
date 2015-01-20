<?php namespace credits\Managers;
use credits\Entities\user;
class CreditManager extends BaseManager
{

    public function getRules()
    {
        $rules=[

            'date_expedition'     => 'required',
            'instead_expedition'     => 'required',
            'office_address'         => 'required',
            'monthly_income'         => 'required',
            'monthly_expenses'         => 'required',
            'name_reference'         => 'required',
            'phone_reference'         => 'required|numeric',
            'name_reference2'         => 'required',
            'phone_reference2'         => 'required',
            'files'         => 'required'

        ];
        return  $rules;
    }

    public function saveCredit()
    {
        $data=$this->prepareData($this->data);
        $user = new User($data);
        $user->save();
        $this->entity->fill($this->prepareData($this->data));
        $user->CreditRequest()->save($this->entity);
    }
}