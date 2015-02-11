<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use credits\Entities\Location;

class LocationSeeder extends Seeder
{

    public function run()
    {



        Location::create([
            'id'=>1,
            'name' => 'Bogota',
        ]);
        Location::create([
            'name' => 'Medellin',
        ]);

    }

}