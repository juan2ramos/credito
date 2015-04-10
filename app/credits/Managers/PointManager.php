<?php namespace credits\Managers;

class PointManager extends BaseManager
{

    public function getRules()
    {
        $rules = [
            'name'          => 'required|unique:points',
            'location_id'   => 'required|numeric'
        ];
        return $rules;
    }
    public function getMessage()
    {
        $messages = [
            'required' => 'El campo es obligatorio.',
            'unique' => 'El punto de venta ya esta registrada',
            'numeric' => 'el campo no esta bien'
        ];
        return $messages;
    }
    public function savePoint()
    {
        $this->entity->fill($this->prepareData($this->data));
        $this->entity->save();
        return "El punto de venta se ha creado correctamente";
    }

}