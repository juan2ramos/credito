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
        $permissions = Permission::whereNotIn('id', $permissionRole->lists('id'))->get();
        $role = $this->roles->getModelNew();
        return View::make('back.role', compact('permissionRole', 'role', 'permissions'));
    }
}