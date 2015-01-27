<?php
use credits\Repositories\RolesRepo;
class RolesController extends BaseController{

        private $roles;

        public function __construct(RolesRepo $rolesRepo){
                $this->roles = $rolesRepo;
        }
        public function showAll(){
                $roles = $this->roles->all();
                return View::make('back.roles',compact('roles'));
        }
        public function show($id){
                $permissionRole = $this->roles->rol($id);
                $role = $this->roles->getModelNew();
                return View::make('back.role',compact('permissionRole','role'));
        }
}