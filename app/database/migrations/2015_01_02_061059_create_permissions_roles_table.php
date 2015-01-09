<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions_roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('permission_id')->unsigned() ;
			$table->foreign('permission_id')->references('id')->on('permissions');
			$table->integer('rol_id')->unsigned() ;
			$table->foreign('rol_id')->references('id')->on('roles');
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
		Schema::drop('permissions_roles');
	}

}
