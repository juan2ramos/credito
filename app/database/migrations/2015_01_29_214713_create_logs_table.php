<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs',function($table)
		{
			$table->string('action');
			$table->string('responsible');
			$table->string('affected_entity');
			$table->string('method');
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
		Schema::drop('logs',function($table)
		{
			$table->drop('logs');
		});
	}

}
