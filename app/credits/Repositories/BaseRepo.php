<?php namespace credits\Repositories;


abstract class BaseRepo {
    
    protected $model;

    public function __construct(){
        $this->model = $this->getModel();
    }
    public function find($id){
        return $this->model->find($id);
    }
    public function all($paginate = 10){
        return $this->model->paginate($paginate);

    }
    abstract protected function getModel();
}