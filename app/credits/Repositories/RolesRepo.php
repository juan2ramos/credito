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

        $this->model->name = Input::get('name');
        $this->model->priority = Input::get('priority');

        $this->model->save();

        $permissions  = Input::get('permission');
        $permissionRole = array();
        if (!empty($permissions)){
            foreach($permissions as $permission){
                $permissionRole = $permissionRole + [$permission => ['available' => 1]];
            }
        }
        $this->model->permissionsRole()->sync($permissionRole);

    }
    public function deleteRol($id){
        $this->model = $this->model->find($id);
        $this->model->permissionsRole()->detach();
        $this->model->delete();
    }
}