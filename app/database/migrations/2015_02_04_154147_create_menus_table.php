<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus',function($table)
		{
			$table->increments('id');
			$table->string('nameMenu');
			$table->string('nameLink');
			$table->string('route');
			$table->string('permission');
			$table->integer('parent');
			$table->integer('orderMenu');
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
		Schema::drop('menus');
	}

}
