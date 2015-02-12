<?php
/**
 * Created by PhpStorm.
 * User: juan2ramos
 * Date: 10/02/15
 * Time: 3:49 PM
 */

namespace credits\Managers;


class RoleManager extends BaseManager
{
    public function getRules()
    {
        $rules = ['name' => 'required|unique:roles',];
        return $rules;
    }

    public function getMessage()
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'unique' => 'El rol ya esta registrado'
        ];
        return $messages;
    }

    public function saveRole()
    {
        $this->entity->fill($this->prepareData($this->data));
        $this->entity->save();

        return "el rol se ha creado correctamente";
    }
}