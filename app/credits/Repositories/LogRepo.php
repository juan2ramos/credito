<?php

namespace credits\Repositories;

use credits\Entities\Log;

class LogRepo extends BaseRepo{

    private $_data;

    public function __construct($data){
        $this->_data= $data;
    }
    protected function getModel()
    {
        return new Log;
    }
    public function log()
    {
        $this->model->fill($this->_data) ;
        $this->model->save();
    }

}