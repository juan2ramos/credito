<?php
use credits\Repositories\RolesRepo;
use credits\Components\ACL\permission;
use credits\Components\ACL\Role;

class RolesController extends BaseController
{

    private $roles;

    public function __construct(RolesRepo $rolesRepo)
    {
        $this->roles = $rolesRepo;
    }

    public function showAll()
    {
        $roles = $this->roles->all();
        return View::make('back.roles', compact('roles'));
    }

    public function show($id)
    {
        $permissionRole = $this->roles->rol($id);
        $role = $this->roles->getModelNew();

        $permissions = ($permissionRole->isEmpty()) ? Permission::orderBy('name')->get():
            Permission::whereNotIn('id', $permissionRole->lists('id'))->orderBy('name')->get();
        return View::make('back.role', compact('permissionRole', 'role', 'permissions'));
    }
    public function updateRol($id){
        $this->roles->updatePermissions($id);
        return Redirect::back()->with(['message' => true]);
    }
    public function newRol(){
        Role::create(array('name' => Input::get('name')));
        return Redirect::back()->with(['message' => true]);
    }
}