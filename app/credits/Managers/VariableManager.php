<?php

namespace credits\Managers;


class VariableManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'value' => 'required|numeric',
            'percentage' =>'required|numeric'
        ];
        return $rules;
    }

    public function getMessage()
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'numeric' => 'El rol ya esta registrado'
        ];
        return $messages;
    }

    public function saveVariables($id)
    {
        $variables=$this->entity->find($id);
        $variables->fill($this->prepareData($this->data));
        $variables->percentage=$this->data['percentage'];
        $variables->save();
    }
}