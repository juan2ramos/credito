<?php namespace credits\Repositories;


abstract class BaseRepo {
    
    protected $model;

    public function __construct(){
        $this->model = $this->getModel();
    }
    public function find($id){
        return $this->model->find($id);
    }
    public function allPaginate($paginate = 10){
        return $this->model->paginate($paginate);
    }
    public function all(){
        return $this->model->all();
    }
    public function getModelNew(){
        return $this->model;
    }
    abstract protected function getModel();

}