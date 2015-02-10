<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use credits\Components\ACL\Permission;
use credits\Components\ACL\PermissionRole;
use credits\Components\ACL\PermissionsUser;

class PermissionsTableSeeder extends Seeder
{

    public function run()
    {

        Permission::create([
            'name' => 'createUser',
        ]);
        Permission::create([
            'name' => 'updateUser',
        ]);
        Permission::create([
            'name' => 'createPermissions',
        ]);
        Permission::create([
            'name' => 'users',
        ]);
        Permission::create([
            'name' => 'roles',
        ]);
        Permission::create([
            'name' => 'slider',
        ]);
        Permission::create([
            'name' => 'location',
        ]);



    }

}