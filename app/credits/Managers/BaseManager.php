<?php namespace credits\Managers;


use Illuminate\Support\Facades\Validator;

abstract class BaseManager
{

    protected $entity;
    protected $data;
    protected $errors;

    public function __construct($entity, $data)
    {
        $this->entity = $entity;
        $this->data = $data;
    }

    abstract public function getRules();

    public function isValid()
    {
        $rules = $this->getRules();
        $message = $this->getMessage();
        $validation = \Validator::make($this->data, $rules,$message);
        if ($validation->fails()) {
           return $validation->errors();
        }
        
        return false;
    }

    public function prepareData($data)
    {
        return $data;
    }
    public function getErrors(){
        return $this->errors;
    }


    public function save()
    {
        !$this->isValid();
        $this->entity->fill($this->prepareData($this->data));
        $this->entity->save();

        return true;
    }

    public function isValidFile(){

        $return = true;
        $files = $this->data['files'];
        $messages = $this->errors->getMessageBag();
        $i=0;
        foreach($files as $file) {

            $rules = array('files' => 'mimes:png,gif,jpeg,pdf,doc|max:20');
            $validatorFile = \Validator::make(array('files'=> $file), $rules);

            if($validatorFile->fails()){
                !$return;
                $errorsFile =  $validatorFile->getMessageBag()->getMessages();
                $errorsFile['files'];
                $messages->add('file'.$i,$errorsFile);
            }
            $i++;
        }
        $this->errors = $messages;
        return $return;
    }
}