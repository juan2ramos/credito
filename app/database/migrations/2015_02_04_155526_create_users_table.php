<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users',function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('last_name');
			$table->string('user_name');
			$table->string('email');
			$table->string('password');
			$table->string('restore_password');
			$table->string('remember_token');
			$table->integer('roles_id');
			$table->string('second_name');
			$table->string('second_last_name');
			$table->string('address');
			$table->string('residency_city');
			$table->string('birth_city');
			$table->integer('mobile_phone');
			$table->integer('phone');
			$table->integer('document_type');
			$table->integer('identification_card');
			$table->date('date_birth');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
