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

    public function getMessage()
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
            'max' => 'El campo :attribute no puede tener más de :max carácteres.',
            'email' => 'El correo esta mal escrito',
            'same' => 'Las contraseñas deben ser iguales',
            'unique' => 'El :attribute ya se encuentra registrado',
            'numeric' => 'El :attribute va en numeros'
        ];
        return $messages;
    }

    public function isValid($validFiles = false)
    {
        $rules = $this->getRules();
        $message = $this->getMessage();
        $validation = \Validator::make($this->data, $rules, $message);

        if ($validation->fails()) {
            return $validation->errors();
            //throw new ValidationException ('Error en los datos', $validation->messages());
        }

        return ;

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