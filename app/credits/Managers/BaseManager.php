<?php namespace credits\Managers;


abstract class BaseManager
{

    protected $entity;
    protected $data;

    public function __construct($entity, $data)
    {

        $this->entity = $entity;
        $this->data = $data;
        //$this->data = array_only($data, array_keys($this->getRules()));

    }

    abstract public function getRules();

    public function isValid()
    {
        $rules = $this->getRules();
        $validation = \Validator::make($this->data, $rules);

        if ($validation->fails()) {
            return $validation->errors();
            //throw new ValidationException ('Error en los datos', $validation->messages());
        }
        return true;

    }

    public function prepareData($data)
    {
        return $data;
    }

    public function save()
    {
        !$this->isValid();
        $this->entity->fill($this->prepareData($this->data));
        $this->entity->save();

        return true;

    }

}