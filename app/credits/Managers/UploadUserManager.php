<?php namespace credits\Managers;
use credits\Entities\User;

class UploadUserManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'identification_card'       => 'required|unique:users,identification_card,'.$this->data["id"].'',
            'name'                      => 'required',
            'second_name'               => 'required',
            'last_name'                 => 'required',
            'second_last_name'          => 'required',
            'user_name'                 => 'required',
            'email'                     => 'email|unique:users,email,'.$this->data["id"].'',
            'address'                   => 'required',
            'residency_city'            => 'required',
            'birth_city'                => 'required',
            'mobile_phone'              => 'required|numeric',
            'phone'                     => 'required|numeric',
            'date_birth'                => 'required',
            'location'                  => 'numeric'


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

    public function uploadUser($id)
    {
        $user=User::find($id);
        $user->update($this->data);
    }


}