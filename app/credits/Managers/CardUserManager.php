<?php namespace credits\Managers;

use credits\Entities\User;


class CardUserManager extends BaseManager
{

    public function getRules()
    {
        $rules = [
            'card' => 'required|numeric'
        ];
        return $rules;
    }

    public function getMessage()
    {
        $messages = [
            'required' => 'El campo  es obligatorio.',
            'numeric' => 'El campo va en numeros'
        ];
        return $messages;
    }

    public function uploadUser($id, $role)
    {
        $data = $this->prepareData($this->data);
        $user = User::find($id);
        $user->update($data);
        return true;

    }
}