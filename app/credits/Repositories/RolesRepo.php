<?php

namespace credits\Repositories;

use credits\Components\ACL\Role;
class RolesRepo extends BaseRepo{

    protected function getModel()
    {
       return new Role;
    }
    public function rol($id){
        $this->model = $this->model->find($id);
        return $this->model->permissionsRole()->get();
    }


}