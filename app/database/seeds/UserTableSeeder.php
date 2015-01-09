<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use credits\Components\ACL\Role;
use credits\Entities\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		Role::Create([
			'name' => 'superAdmin',
		]);
		Role::Create([
			'name' => 'admin',
		]);
		Role::Create([
			'name' => 'register',
		]);
		foreach(range(1,10) as $index){
			$nameExtend = $faker->name;
			$nameExtend = explode(' ', $nameExtend);
			$name = array_shift($nameExtend);
			$last_name = implode(" ", $nameExtend);;
			User::create([
				'name' => $name,
				'last_name' => $last_name,
				'user_name' => $faker->userName,
				'email' => $faker->email,
				'password' => \Hash::make(12345),
				'roles_id' => $faker->randomElement([1,2,3])

			]);
		}



	}

}