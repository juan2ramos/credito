<?php
use credits\Repositories\RolesRepo;
use credits\Components\ACL\permission;

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

        $permissions = ($permissionRole->isEmpty()) ? Permission::all():
            Permission::whereNotIn('id', $permissionRole->lists('id'))->get();
        return View::make('back.role', compact('permissionRole', 'role', 'permissions'));
    }
    public function updateRol($id){
        $this->roles->updatePermissions($id);
        return Redirect::back()->with([

            'alert'			=>	'Pacote atualizado com sucesso!',
            'alert_type' 	=> 	'alert-success'

        ]);
    }
}