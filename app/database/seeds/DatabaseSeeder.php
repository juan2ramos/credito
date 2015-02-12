<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

	 	$this->call('LocationSeeder');
		$this->call('PermissionsTableSeeder');
		$this->call('MenuTableSeeder');
	 	$this->call('UserTableSeeder');



	}

}
