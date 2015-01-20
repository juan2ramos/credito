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
            'files'         => 'required',

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

        $files = $this->data['files'];
        foreach($files as $file) {
            $rules += array('files' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'

            //$validator = \Validator::make(array('files'=> $file), $rules);

        }

        ddj($rules);exit;
        return  $rules;
    }



    public function saveCredit()
    {
        $file = $this->data->file('files');

        if(empty ($file)){
            return Redirect::to('credito')->with([''])->withInput();
        }


        $data=$this->prepareData($this->data);
        $user = new User($data);
        $user->save();
        $this->entity->fill($this->prepareData($this->data));
        $user->CreditRequest()->save($this->entity);

        $fileName = $file->getClientOriginalName();
        $file->move("img",$fileName);
    }
}