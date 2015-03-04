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
            'mobile_phone'              => 'required|numeric',
            'address'                   => 'required',
            'roles_id'                  => 'required|numeric',
            'location'                  => 'required|numeric'


        ];
        return  $rules;
    }

    public function getMessage()
    {
        $messages = [
            'required'  => 'El campo :attribute es obligatorio.',
            'same'      => 'Las contraseñas deben ser iguales'
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