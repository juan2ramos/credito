<?php namespace credits\Managers;
use credits\Entities\User;

class UserManager extends BaseManager
{

    public function getRules()
    {
        $rules=[

            'password'              => 'required',
            'confirmar_password'    => 'required|same:password'


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

    public function savePassword($restore_password)
    {

        $user = User::where('restore_password', '=', $restore_password)->first();
        $user->password=$this->data['password'];
        if($user->save())
        {
            return $user->user_name;
        }
            return false;

    }


}