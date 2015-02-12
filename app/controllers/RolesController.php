<?php
use credits\Repositories\RolesRepo;
use credits\Components\ACL\permission;
use credits\Components\ACL\Role;
use credits\Managers\RoleManager;

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
        $nameRol = (Lang::has('utils.roles.' . $role->name)) ?
            Lang::get('utils.roles.' . $role->name) :
            $role->name;

        $permissions = ($permissionRole->isEmpty()) ? Permission::orderBy('name')->get() :
            Permission::whereNotIn('id', $permissionRole->lists('id'))->orderBy('name')->get();
        return View::make('back.role', compact('permissionRole', 'role', 'permissions','nameRol'));
    }

    public function updateRol($id)
    {
        $this->roles->updatePermissions($id);
        return Redirect::back()->with(['message' => true]);
    }

    public function newRol()
    {

        $roleManager = new RoleManager(new Role(),Input::all());
        $roleValidator = $roleManager->isValid();
        if ($roleValidator) {
            return Redirect::back()->withErrors($roleValidator)->withInput();
        }
        return Redirect::back()->with(['message' => $roleManager->saveRole()]);
    }

    public function deleteRol($id)
    {
        $this->roles->deleteRol($id);
        return Redirect::back()->with(['message' => true]);
    }
}