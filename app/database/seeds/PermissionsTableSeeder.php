<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use credits\Components\ACL\Permission;
use credits\Components\ACL\PermissionsRole;
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
        $faker = Faker::create();

        foreach(range( 1, 10 ) as $index){
            PermissionsRole::create([
                'permission_id' => $faker->randomElement([1,2,3]),
                'rol_id' => $faker->randomElement([1,2,3]),
                'available' => true
            ]);
        }
        foreach(range( 1, 10 ) as $index){
            PermissionsUser::create([
                'permission_id' => $faker->randomElement([1,2,3]),
                'user_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
                'available' => true
            ]);
        }
    }

}