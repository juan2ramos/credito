<?php

namespace credits\Repositories;

use credits\Entities\Log;

class LogRepo extends BaseRepo{

    private $_data;

    public function __construct($data){
        $this->model = $this->getModel();
        $this->_data= $data;
        $this->saveLog();
    }
    protected function getModel(){
        return new Log();
    }
    public function saveLog()
    {
        $this->model->fill($this->_data) ;
        $this->model->save();
    }

}