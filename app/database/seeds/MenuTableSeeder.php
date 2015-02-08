<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use credits\Components\Menu\Menu;

class MenuTableSeeder extends Seeder
{

    public function run()
    {



            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'inicio',
                'route' => 'home',
                'permission' => '',
                'orderMenu' => '1'
            ]);
            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'Solicitud de crédito',
                'route' => 'credit',
                'permission' => '',
                'orderMenu' => '2'

            ]);
            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'usuarios',
                'route' => 'users',
                'permission' => 'users',
                'orderMenu' => '3'
            ]);
            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'roles',
                'route' => 'roles',
                'permission' => 'roles',
                'orderMenu' => '4'
            ]);
            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'slider',
                'route' => 'slider',
                'permission' => '',
                'orderMenu' => '5'
            ]);

    }

}