<?php namespace credits\Managers;
use credits\Entities\User;
use Carbon\Carbon;

class NewUserManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'name'                      => 'required',
            'last_name'                 => 'required',
            'user_name'                 => 'required|unique:users',
            'email'                     => 'required|email|unique:users',
            'mobile_phone'              => 'required|numeric|digits_between:6,11',
            'address'                   => 'required',
            'roles_id'                  => 'required|numeric',
            'location'                  => 'required|numeric'


        ];
        return  $rules;
    }

    public function getMessage()
    {
        $messages = [
            'required'              => 'El campo es obligatorio.',
            'digits_between'        => 'El campo debe ser mayor de 6 y menor de 11',
            'numeric'               => 'El campo debe ser numercio',
            'unique'                => 'El campo ya se encuentra registrado',
            'email'                 => 'El Correo esta mal escrito'
        ];
        return $messages;
    }

    public function createUser()
    {
        $data=$this->prepareData($this->data);
        $user=new User($data);
        $user->save();

    }

}