<?php

namespace credits\Repositories;

use credits\Components\ACL\Role;
use Illuminate\Support\Facades\Input;

class RolesRepo extends BaseRepo{

    protected function getModel()
    {
       return new Role;
    }
    public function rol($id){
        $this->model = $this->model->find($id);
        return $this->model->permissionsRole()->get();
    }

    /**
     * @param $id
     */
    public function updatePermissions($id){
        $this->model = $this->model->find($id);
        $permissions  = Input::get('permission');
        $permissionRole = array();

        foreach($permissions as $permission){
            $permissionRole = $permissionRole + [$permission => ['available' => 1]];
        }
        $this->model->permissionsRole()->sync($permissionRole);

    }


}