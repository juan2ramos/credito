<?php namespace credits\Managers;

class LocationManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'name'   => 'required|unique:locations',

        ];

        return  $rules;
    }




    public function getMessage()
    {
        $messages = [
            'required'      => 'El campo :attribute es obligatorio.',
            'unique'        => 'La Region ya esta registrada'
        ];
        return $messages;
    }

    public function saveLocation()
    {
        $this->entity->fill($this->prepareData($this->data));
        $this->entity->save();
        return "la region se ha creado correctamente";
    }

}