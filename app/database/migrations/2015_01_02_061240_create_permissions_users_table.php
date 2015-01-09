<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions_users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('permission_id')->unsigned() ;
			$table->foreign('permission_id')->references('id')->on('permissions');
			$table->integer('user_id')->unsigned() ;
			$table->foreign('user_id')->references('id')->on('users');
			$table->boolean('available');

			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permissions_users');
	}

}
