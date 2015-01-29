<?php

namespace credits\Repositories;

use credits\Entities\Log;

class LogRepo extends BaseRepo{

    protected function getModel()
    {

    }
    public function log($responsible,$action,$affected_entity,$method)
    {
        $log=new Log();
        $log->responsible=$responsible;
        $log->action=$action;
        $log->affected_entity=$affected_entity;
        $log->method=$method;
        $log->save();
    }

}