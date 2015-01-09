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
                'nameLink' => 'home',
                'route' => '/',
                'permission' => '',
                'orderMenu' => '1'
            ]);
            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'about',
                'route' => 'about',
                'permission' => '',
                'orderMenu' => '2'

            ]);
            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'contact',
                'route' => 'contact',
                'permission' => '',
                'parent' => 1,
                'orderMenu' => '1'
            ]);
            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'home1',
                'route' => 'home1',
                'permission' => '',
                'parent' => 1,
                'orderMenu' => '1'
            ]);
            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'home2',
                'route' => 'home2',
                'permission' => '',
                'parent' => 1,
                'orderMenu' => '1'
            ]);
            Menu::create([
                'nameMenu' => 'principal',
                'nameLink' => 'home21',
                'route' => 'home21',
                'permission' => '',
                'parent' => 5,
                'orderMenu' => '1'
            ]);

    }

}