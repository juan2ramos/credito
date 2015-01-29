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
		Schema::table('logs',function($table)
		{
			$table->dropColumn('name');
			$table->string('responsible');
			$table->string('affected_entity');
			$table->string('method');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('logs',function($table)
		{
			$table->drop('logs');
		});
	}

}
