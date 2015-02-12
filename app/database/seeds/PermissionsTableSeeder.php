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
            'id'    => 1,
            'name' => 'createUser',
        ]);
        Permission::create([
            'id'    => 2,
            'name' => 'updateUser',
        ]);
        Permission::create([
            'id'    => 3,
            'name' => 'createPermissions',
        ]);
        Permission::create([
            'id'    => 4,
            'name' => 'users',
        ]);
        Permission::create([
            'id'    => 5,
            'name' => 'roles',
        ]);
        Permission::create([
            'id'    => 6,
            'name' => 'slider',
        ]);
        Permission::create([
            'id'    => 7,
            'name' => 'location',
        ]);



    }

}